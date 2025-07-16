<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error {{ $exception->getStatusCode() ?? 404 }} - Kosan Pink</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-pink-50 flex items-center justify-center min-h-screen">
    <div class="text-center px-6">
        <h1 class="text-7xl font-extrabold text-pink-600 mb-4">
            {{ $exception->getStatusCode() ?? 404 }}
        </h1>
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
            {{ $exception->getMessage() ?: 'Halaman Tidak Ditemukan' }}
        </h2>
        <p class="text-gray-600 mb-8">
            Maaf, halaman yang Anda cari tidak ditemukan atau terjadi kesalahan pada sistem.
        </p>

        <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-pink-600 text-white font-medium rounded-md hover:bg-pink-700 transition duration-300">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>
