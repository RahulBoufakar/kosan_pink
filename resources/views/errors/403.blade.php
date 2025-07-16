<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-50 flex items-center justify-center min-h-screen">
    <div class="text-center px-6">
        <h1 class="text-7xl font-extrabold text-pink-600 mb-4">403</h1>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Akses Ditolak</h2>
        <p class="text-gray-600 mb-8">
            Anda tidak memiliki izin untuk mengakses halaman ini.
        </p>
        <a href="{{ url('/') }}" class="px-6 py-3 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition">Kembali ke Beranda</a>
    </div>
</body>
</html>
