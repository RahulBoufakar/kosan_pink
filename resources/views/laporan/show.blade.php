@extends('layouts.app')

@section('title', 'Detail Laporan - Kosan Pink')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('laporan.index') }}" class="text-pink-600 hover:text-pink-700 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Laporan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-pink-50">
            <h2 class="text-xl font-semibold text-pink-600">Detail Laporan</h2>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Informasi Laporan</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Laporan</p>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="mt-1">
                                @if($laporan->status_laporan == 'proses')
                                <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span>Dalam Proses</span>
                                </span>
                                @else
                                <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    <span>Selesai</span>
                                </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Deskripsi</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700">{{ $laporan->deskripsi }}</p>
                    </div>
                </div>
            </div>

            @if($laporan->media)
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Lampiran</h3>
                @if(Str::contains($laporan->media, ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ asset('storage/' . $laporan->media) }}" alt="Lampiran Laporan" class="max-w-full h-auto rounded-lg shadow">
                @elseif(Str::contains($laporan->media, ['mp4', 'avi', 'mov']))
                    <video controls class="max-w-full rounded-lg shadow">
                        <source src="{{ asset('storage/' . $laporan->media) }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutaran video.
                    </video>
                @endif
            </div>
            @endif
        </div>

        @if($laporan->status_laporan == 'proses')
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
            <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                    <i class="fas fa-trash mr-1"></i> Hapus Laporan
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection