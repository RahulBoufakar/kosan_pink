@extends('layouts.app')

@section('title', 'Dashboard - Kosan Pink')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <!-- Welcome Section -->
    <div class="mb-8 bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold text-pink-600">Selamat Datang, {{ Auth::user()->name }}!</h1>
        @if(Auth::user()->kamar)
            <div class="mt-4 flex items-center">
                <i class="fas fa-door-open text-pink-500 mr-2"></i>
                <span class="text-gray-700">Kamar: {{ Auth::user()->kamar->nomor_kamar }}</span>
            </div>
        @endif
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Unpaid Bills Card -->
        <a href="{{ route('tagihan.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-md transition duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                    <i class="fas fa-money-bill-wave text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Tagihan Belum Dibayar</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $unpaidBillsCount }}</p>
                </div>
            </div>
        </a>

        <!-- Unfinished Reports Card -->
        <a href="{{ route('laporan.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-md transition duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                    <i class="fas fa-clipboard-list text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Laporan Belum Selesai</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $unfinishedReportsCount }}</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="{{ route('tagihan.index') }}" class="px-4 py-3 bg-pink-50 text-pink-600 rounded-md hover:bg-pink-100 transition flex items-center">
                <i class="fas fa-money-bill-wave mr-2"></i> Lihat Tagihan
            </a>
            <a href="{{ route('laporan.create') }}" class="px-4 py-3 bg-pink-50 text-pink-600 rounded-md hover:bg-pink-100 transition flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Buat Laporan Baru
            </a>
        </div>
    </div>
</div>
@endsection