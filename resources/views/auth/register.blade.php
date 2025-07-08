@extends('layouts.app')

@section('title', 'Daftar Akun - Kosan Pink')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-pink-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-pink-600">Daftar Akun Penyewa</h2>
            <p class="mt-2 text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-medium text-pink-600 hover:text-pink-500">
                    Masuk disini
                </a>
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="role" value="user">

            <div class="space-y-4">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input id="name" name="name" type="text" required autofocus
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                    <input id="no_hp" name="no_hp" type="tel" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                        value="{{ old('no_hp') }}">
                    @error('no_hp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kamar Selection -->
                <div>
                    <label for="kamar_id" class="block text-sm font-medium text-gray-700">Pilih Kamar</label>
                    <select id="kamar_id" name="kamar_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        <option value="">-- Pilih Kamar --</option>
                        @foreach($availableRooms as $room)
                            <option value="{{ $room->id }}" {{ old('kamar_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->nomor_kamar }} ({{ $room->status }})
                            </option>
                        @endforeach
                    </select>
                    @error('kamar_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection