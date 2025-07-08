@extends('layouts.app')

@section('title', 'Buat Laporan Baru - Kosan Pink')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-pink-600">Buat Laporan Baru</h1>
        <p class="mt-2 text-gray-600">Laporkan masalah atau keluhan Anda</p>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-pink-50">
            <h2 class="text-lg font-medium text-pink-600">Form Laporan</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Masalah</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="media" class="block text-sm font-medium text-gray-700">Lampiran (Opsional)</label>
                    <input type="file" id="media" name="media" accept="image/*,video/*"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, atau MP4 (Max: 20MB)</p>
                    @error('media')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('laporan.index') }}" class="mr-2 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection