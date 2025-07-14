@extends('layouts.app')

@section('title', 'Daftar Laporan - Kosan Pink')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-2xl font-bold text-pink-600">Daftar Laporan</h1>
        <a href="{{ route('laporan.create') }}" class=" md:w-auto px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition flex items-center justify-center">
            <i class="fas fa-plus mr-2"></i> Buat Laporan Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mobile View (Cards) -->
    <div class="md:hidden space-y-4">
        @forelse($laporans as $laporan)
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Tanggal</p>
                    <p class="text-gray-800">
                        {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->translatedFormat('d M Y H:i') }}
                    </p>
                </div>
                <div>
                    @if($laporan->status_laporan == 'proses')
                        <span class="px-2 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i> Proses
                        </span>
                    @else
                        <span class="px-2 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i> Selesai
                        </span>
                    @endif
                </div>
            </div>

            <div class="mt-3">
                <p class="text-sm font-medium text-gray-500">Deskripsi</p>
                <p class="text-gray-800">
                    {{ Str::limit($laporan->deskripsi, 70) }}
                </p>
            </div>

            <div class="mt-4 flex space-x-3">
                <a href="{{ route('laporan.show', $laporan->id) }}" 
                   class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-eye mr-2"></i> Detail
                </a>
                
                @if($laporan->status_laporan == 'proses')
                <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </form>
                @endif
            </div>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-gray-500">Belum ada laporan yang dibuat</p>
            <a href="{{ route('laporan.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700">
                <i class="fas fa-plus mr-2"></i> Buat Laporan Pertama
            </a>
        </div>
        @endforelse
    </div>

    <!-- Desktop View (Table) -->
    <div class="hidden md:block bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-pink-600 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-pink-600 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-pink-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-pink-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($laporans as $laporan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">
                        {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->translatedFormat('d F Y H:i') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-center text-gray-600">
                        {{ Str::limit($laporan->deskripsi, 50) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($laporan->status_laporan == 'proses')
                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i> Dalam Proses
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                        <a href="{{ route('laporan.show', $laporan->id) }}" class="text-pink-600 hover:text-pink-900 mr-3">
                            <i class="fas fa-eye mr-1"></i> Lihat
                        </a>
                        @if($laporan->status_laporan == 'proses')
                            <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                        Belum ada laporan yang dibuat
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($laporans->hasPages())
        <div class="mt-4">
            {{ $laporans->links() }}
        </div>
    @endif
</div>
@endsection