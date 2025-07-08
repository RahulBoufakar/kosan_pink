<form method="post" action="{{ route('password.update') }}" class="space-y-6">
    @csrf
    @method('put')

    <div>
        <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
        <input type="password" name="current_password" id="current_password" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
        @error('current_password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
        <input type="password" name="password" id="password" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
        @error('password_confirmation')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end">
        <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700">
            Update Password
        </button>
    </div>
</form>