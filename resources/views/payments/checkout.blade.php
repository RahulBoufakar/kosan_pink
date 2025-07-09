@extends('layouts.app')

@section('title', 'Pembayaran Tagihan - Kosan Pink')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-pink-600">Pembayaran Tagihan</h1>
            <p class="mt-2 text-gray-600">Lengkapi pembayaran untuk tagihan kos Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-pink-50">
                        <h2 class="text-lg font-medium text-pink-600">Detail Tagihan</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-sm text-gray-500">Nomor Tagihan</p>
                                <p class="font-medium">T-{{ str_pad($tagihan->id, 6, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Tagihan</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($tagihan->tanggal_tagihan)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Jumlah Tagihan</p>
                                <p class="font-medium text-pink-600">Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                <p class="font-medium">
                                    @if($tagihan->status === 'paid')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                            Sudah Dibayar
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">
                                            Belum Dibayar
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Metode Pembayaran Tersedia</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="p-4 border rounded-lg">
                                    <i class="fas fa-university text-2xl text-blue-500 mb-2"></i>
                                    <p>Transfer Bank</p>
                                </div>
                                <div class="p-4 border rounded-lg">
                                    <i class="fab fa-google-pay text-2xl text-green-500 mb-2"></i>
                                    <p>Gopay</p>
                                </div>
                                <div class="p-4 border rounded-lg">
                                    <i class="fas fa-store text-2xl text-orange-500 mb-2"></i>
                                    <p>ShopeePay</p>
                                </div>
                                <div class="p-4 border rounded-lg">
                                    <i class="fas fa-qrcode text-2xl text-purple-500 mb-2"></i>
                                    <p>QRIS</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white rounded-lg shadow overflow-hidden sticky top-4">
                    <div class="px-6 py-4 border-b border-gray-200 bg-pink-50">
                        <h2 class="text-lg font-medium text-pink-600">Ringkasan Pembayaran</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span>Tagihan Kos</span>
                                <span>Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Biaya Admin</span>
                                <span>Rp 0</span>
                            </div>
                            <div class="border-t border-gray-200 pt-4 flex justify-between font-semibold">
                                <span>Total Pembayaran</span>
                                <span class="text-pink-600">Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        @if($tagihan->status !== 'paid')
                            <button id="pay-button" 
                                class="mt-6 w-full px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700">
                                Lanjutkan Pembayaran
                            </button>
                        @else
                            <a href="{{ route('payments.receipt', $tagihan->payment) }}"
                                class="mt-6 w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-center block">
                                Lihat Bukti Pembayaran
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var payBtn = document.getElementById('pay-button');
            if (payBtn) {
                payBtn.onclick = function(){
                    snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result){
                            // Handle successful payment
                            console.log('Payment Success:', result);
                            window.location.href = "{{ route('payments.receipt', $tagihan->payment->id) }}";
                        },
                        onPending: function(result){
                            // Handle pending payment
                            console.log('Payment Pending:', result);
                            alert('Pembayaran masih dalam proses. Silakan cek kembali nanti.');
                        },
                        onError: function(result){
                            // Handle error in payment
                            console.error('Payment Error:', result);
                            alert('Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
                        }
                    });
                };
            }
        });
        
    </script>
@endpush
@endsection