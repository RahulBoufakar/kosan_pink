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

    <!-- Mobile View (Cards) - Show on screens smaller than sm (640px) -->
    <div class="block sm:hidden space-y-4">
        @forelse($tagihans as $tagihan)
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Tanggal</p>
                    <p class="text-gray-800">
                        {{ \Carbon\Carbon::parse($tagihan->tanggal_tagihan)->translatedFormat('d M Y') }}
                    </p>
                </div>
                <div>
                    @if($tagihan->status == 'paid')
                        <span class="px-2 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i> Lunas
                        </span>
                    @else
                        <span class="px-2 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i> Belum Bayar
                        </span>
                    @endif
                </div>
            </div>

            <div class="mt-3">
                <p class="text-sm font-medium text-gray-500">Jumlah</p>
                <p class="text-lg font-semibold text-gray-900">
                    Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}
                </p>
            </div>

            <div class="mt-4">
                @if($tagihan->status == 'pending')
                    <a href="{{ route('payments.checkout', $tagihan) }}" 
                       class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-pink-600 hover:bg-pink-700">
                        <i class="fas fa-money-bill-wave mr-2"></i> Bayar
                    </a>
                @else
                    <a href="{{ route('payments.receipt', $tagihan->payment) }}" 
                       class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-receipt mr-2"></i> Resi
                    </a>
                @endif
            </div>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-gray-500">Tidak ada tagihan saat ini</p>
        </div>
        @endforelse
    </div>

    <!-- Desktop View (Table) - Show on sm screens and larger (≥640px) -->
    <div class="hidden sm:block bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-4 sm:px-6 py-3 text-center text-xs font-medium text-pink-600 uppercase tracking-wider">Tanggal</th>
                    <th class="px-4 sm:px-6 py-3 text-center text-xs font-medium text-pink-600 uppercase tracking-wider">Jumlah</th>
                    <th class="px-4 sm:px-6 py-3 text-center text-xs font-medium text-pink-600 uppercase tracking-wider">Status</th>
                    <th class="px-4 sm:px-6 py-3 text-center text-xs font-medium text-pink-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($tagihans as $tagihan)
                <tr>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-center">
                        {{ \Carbon\Carbon::parse($tagihan->tanggal_tagihan)->translatedFormat('d M Y') }}
                    </td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-center">
                        Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}
                    </td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-center">
                        @if($tagihan->status == 'paid')
                            <span class="px-2 sm:px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> <span class="sm:inline">Lunas</span>
                            </span>
                        @else
                            <span class="px-2 sm:px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i> <span class="sm:inline">Belum Bayar</span>
                            </span>
                        @endif
                    </td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                        @if($tagihan->status == 'pending')
                            <a href="{{ route('payments.checkout', $tagihan) }}" class="text-pink-600 hover:text-pink-900 flex items-center justify-center">
                                <i class="fas fa-money-bill-wave mr-1"></i> <span class="sm:inline">Bayar</span>
                            </a>
                        @else
                            <a href="{{ route('payments.receipt', $tagihan->payment) }}" class="text-blue-600 hover:text-blue-900 flex items-center justify-center">
                                <i class="fas fa-receipt mr-1"></i> <span class="sm:inline">Resi</span>
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