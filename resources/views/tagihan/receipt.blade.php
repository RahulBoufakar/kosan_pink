@extends('layouts.app')

@section('title', 'Resi Pembayaran - Kosan Pink')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-pink-600">Resi Pembayaran</h1>
            <p class="mt-2 text-gray-600">Bukti pembayaran tagihan kos Anda</p>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-pink-50">
                <h2 class="text-lg font-medium text-pink-600">Detail Pembayaran</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div>
                        <p class="text-sm text-gray-500">Nomor Tagihan</p>
                        <p class="font-medium">T-{{ str_pad($tagihan->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Pembayaran</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($payment->paid_at)->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Metode Pembayaran</p>
                        <p class="font-medium capitalize">{{ $payment->payment_method }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="font-medium">
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                Lunas
                            </span>
                        </p>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex justify-between mb-2">
                        <span>Jumlah Tagihan</span>
                        <span>Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between font-semibold text-lg">
                        <span>Total Dibayar</span>
                        <span class="text-pink-600">Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-8 bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-medium text-gray-900 mb-2">ID Transaksi</h3>
                    <p class="text-sm text-gray-600">{{ $payment->midtrans_transaction_id }}</p>
                    
                    <div class="mt-4">
                        <a href="#" class="text-pink-600 hover:text-pink-700 inline-flex items-center">
                            <i class="fas fa-download mr-2"></i> Unduh Resi (PDF)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('tagihan.index') }}" class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Tagihan
            </a>
        </div>
    </div>
</div>
@endsection