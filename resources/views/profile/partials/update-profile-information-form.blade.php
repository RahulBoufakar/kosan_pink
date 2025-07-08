<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="space-y-6">
    @csrf
    @method('patch')

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="text-sm text-gray-600">
                    Email Anda belum terverifikasi.
                    <button form="send-verification" class="text-pink-600 hover:text-pink-500">
                        Klik di sini untuk mengirim ulang email verifikasi.
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-1 text-sm text-green-600">
                        Link verifikasi baru telah dikirim ke alamat email Anda.
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="flex items-center justify-end">
        <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700">
            Simpan Perubahan
        </button>
    </div>
</form>