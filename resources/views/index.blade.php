@extends('layouts.app')

@section('title', 'Kosan Pink - Tempat Nyaman untuk Tinggal')

@section('content')
    <!-- Hero Section -->
    <section class="py-20">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                    Selamat Datang DI Website
                </h1>
                <h2 class="text-3xl md:text-4xl font-bold text-pink-600 mb-6">
                    Kosan Pink
                </h2>
                <p class="text-lg text-gray-600 mb-8">
                    Tempat tinggal nyaman dengan fasilitas lengkap dan harga terjangkau. 
                    Dapatkan pengalaman menginap terbaik di Kosan Pink.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#fasilitas" class="px-6 py-3 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition duration-300 text-center">
                        Lihat Fasilitas
                    </a>
                </div>
            </div>
            <div class="md:w-1/2">
                <img src="{{ asset('images/kosan-hero.jpg') }}" alt="Kosan Pink" class="rounded-lg shadow-xl w-full">
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section id="fasilitas" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Fasilitas Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Fasilitas 1 -->
                <div class="bg-pink-50 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-pink-600 text-4xl mb-4">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Internet Cepat</h3>
                    <p class="text-gray-600">Akses internet cepat 24 jam untuk kebutuhan kerja dan hiburan Anda.</p>
                </div>
                
                <!-- Fasilitas 2 -->
                <div class="bg-pink-50 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-pink-600 text-4xl mb-4">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Dapur Bersama</h3>
                    <p class="text-gray-600">Dapur lengkap yang bisa digunakan bersama oleh semua penghuni kos.</p>
                </div>
                <!-- Fasilitas 3 -->
                <div class="bg-pink-50 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-pink-600 text-4xl mb-4">
                        <i class="fas fa-toilet"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Kamar Mandi Bersama 2</h3>
                    <p class="text-gray-600">Kamar mandi yang selalu dibersihkan dan diwangi setiap hari.</p>
                </div>
            </div>
        </div>
    </section>
@endsection