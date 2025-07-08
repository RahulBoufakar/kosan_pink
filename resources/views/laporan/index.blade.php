@extends('layouts.app')

@section('title', 'Daftar Laporan - Kosan Pink')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-pink-600">Daftar Laporan</h1>
        <a href="{{ route('laporan.create') }}" class="px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition flex items-center">
            <i class="fas fa-plus mr-2"></i> Buat Laporan Baru
        </a>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($laporans as $laporan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->translatedFormat('d F Y H:i') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ Str::limit($laporan->deskripsi, 50) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($laporan->status_laporan == 'proses')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i> Dalam Proses
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
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