<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Halaman Kedaluwarsa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-50 flex items-center justify-center min-h-screen">
    <div class="text-center px-6">
        <h1 class="text-7xl font-extrabold text-pink-600 mb-4">419</h1>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Sesi Telah Kedaluwarsa</h2>
        <p class="text-gray-600 mb-8">
            Formulir yang Anda kirim sudah tidak berlaku. Silakan coba lagi.
        </p>
        <a href="{{ url()->previous() }}" class="px-6 py-3 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition">Kembali</a>
    </div>
</body>
</html>
