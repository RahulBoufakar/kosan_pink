@extends('layouts.app')

@section('title', 'Daftar Tagihan - Kosan Pink')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-pink-600">Daftar Tagihan</h1>
        <p class="mt-2 text-gray-600">Riwayat tagihan kos Anda</p>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Tanggal Tagihan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($tagihans as $tagihan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($tagihan->tanggal_tagihan)->translatedFormat('d F Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($tagihan->status == 'paid')
                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Lunas
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i> Belum Bayar
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        @if($tagihan->status == 'pending')
                            <a href="{{ route('payments.checkout', $tagihan) }}" 
                               class="text-pink-600 hover:text-pink-900">
                                <i class="fas fa-money-bill-wave mr-1"></i> Bayar
                            </a>
                        @else
                            <a href="{{ route('payments.receipt', $tagihan->payment) }}" 
                               class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-receipt mr-1"></i> Lihat Resi
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                        Tidak ada tagihan saat ini
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($tagihans->hasPages())
        <div class="mt-4">
            {{ $tagihans->links() }}
        </div>
    @endif
</div>
@endsection