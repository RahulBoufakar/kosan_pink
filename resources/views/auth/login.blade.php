@extends('layouts.app')

@section('title', 'Masuk - Kosan Pink')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-pink-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-pink-600">Masuk ke Akun Anda</h2>
            <p class="mt-2 text-sm text-gray-600">
                Atau 
                <a href="{{ route('register') }}" class="font-medium text-pink-600 hover:text-pink-500">
                    daftar akun baru
                </a>
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="space-y-4">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                        value="{{ old('email') }}">
                    @error('email')
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

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-pink-600 hover:text-pink-500">
                                Lupa password?
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection