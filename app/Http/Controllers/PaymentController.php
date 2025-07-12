<?php

// app/Http/Controllers/PaymentController.php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkout(Tagihan $tagihan)
    {
        // Check authorization
        if ($tagihan->user_id !== auth()->id()) {
            abort(403);
        }

        // If already paid, show receipt
        if ($tagihan->status === 'paid') {
            return redirect()->route('payments.receipt', $tagihan->payment);
        }
        // Create or get existing payment
        $payment = $tagihan->payment ?? Payment::create([
            'tagihan_id' => $tagihan->id,
            'user_id' => auth()->id(),
            'order_id' => 'MIDTRANS-'.$tagihan->id.'-'.Carbon::now()->format('Ymd'),
            'snap_token' => '',
            'payment_type' => null,
            'transaction_id' => null,
            'paid_at' => null
        ])->load(['tagihan.user']);

        // Load payment details
        $tagihan->load('payment');

        $config = config('midtrans');

        if (empty($config['server_key']) || empty($config['client_key'])) {
            throw new \Exception('Midtrans server_key or client_key is not set. Please check your config/midtrans.php and .env file.');
        }

        \Midtrans\Config::$serverKey = $config['server_key'];
        \Midtrans\Config::$clientKey = $config['client_key'];
        \Midtrans\Config::$isProduction = $config['is_production'];
        \Midtrans\Config::$isSanitized = $config['is_sanitized'] ?? true;
        \Midtrans\Config::$is3ds = $config['is_3ds'] ?? true;
        // Generate new snap token if needed (manual params)
        if (empty($payment->snap_token)) {
            $params = [
                'transaction_details' => [
                    'order_id' => $payment->order_id,
                    'gross_amount' => $tagihan->jumlah_tagihan,
                ],
                'customer_details' => [
                    'first_name' => $tagihan->user->name,
                    'email' => $tagihan->user->email,
                    'phone' => $tagihan->user->no_hp,
                ]
            ];
            $payment->snap_token = \Midtrans\Snap::getSnapToken($params);
            $payment->save();
        }
        return view('payments.checkout', [
            'snapToken' => $payment->snap_token,
            'tagihan' => $tagihan
        ]);
    }

    public function callback(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required',
            'transaction_status' => 'required',
            'payment_type' => 'required',
            'transaction_id' => 'required'
        ]);

        $payment = Payment::where('order_id', $validated['order_id'])->first();

        if (!$payment) {
            return response()->json(['success' => false, 'message' => 'Payment not found.'], 404);
        }

        if (in_array($validated['transaction_status'], ['capture', 'settlement'])) {
            $payment->update([
                'payment_type' => $validated['payment_type'],
                'transaction_id' => $validated['transaction_id'],
                'paid_at' => now()
            ]);

            $payment->tagihan->update(['status' => 'paid']);
        }

        return response()->json(['success' => true]);
    }

    public function receipt(Payment $payment)
    {
        // Check authorization
        if ($payment->user_id !== auth()->id()) {
            abort(403);
        }

        // Load relationships
        $payment->load('tagihan.user');

        return view('tagihan.receipt', [
            'payment' => $payment,
            'tagihan' => $payment->tagihan,
            'isManual' => $payment->payment_type === 'manual_transfer'
        ]);
    }
}