@extends('layouts.app')

@section('title', 'Edit Profil - Kosan Pink')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-pink-600">Edit Profil</h1>
        <p class="mt-2 text-gray-600">Kelola informasi profil dan akun Anda</p>
    </div>

    <!-- Update Profile Information -->
    <div class="mb-8 bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-pink-50">
            <h2 class="text-lg font-medium text-pink-600">Informasi Profil</h2>
        </div>
        <div class="p-6">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Update Password -->
    <div class="mb-8 bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-pink-50">
            <h2 class="text-lg font-medium text-pink-600">Update Password</h2>
        </div>
        <div class="p-6">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Delete Account -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-pink-50">
            <h2 class="text-lg font-medium text-pink-600">Hapus Akun</h2>
        </div>
        <div class="p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection