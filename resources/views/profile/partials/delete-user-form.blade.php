<form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
    @csrf
    @method('delete')

    <div>
        <h3 class="text-lg font-medium text-gray-900">Hapus Akun</h3>
        <p class="mt-1 text-sm text-gray-600">
            Setelah akun Anda dihapus, semua data akan dihapus secara permanen. 
            Sebelum menghapus akun, harap unduh data apa pun yang ingin Anda simpan.
        </p>
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end">
        <button type="button" onclick="confirmDelete()" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
            Hapus Akun
        </button>
    </div>
</form>

@push('scripts')
<script>
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan.')) {
            document.forms[document.forms.length - 1].submit();
        }
    }
</script>
@endpush