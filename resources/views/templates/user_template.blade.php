<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title-page', 'Kosan Pink')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoA6DQD1P1Uj/6KOz1C1og6L2Qp1Kk5j6tZT53URy9Bv1W" crossorigin="anonymous">
</head>
<body>
    @yield('navbar')
    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoA6DQD1P1Uj/6KOz1C1og6L2Qp1Kk5j6tZT53URy9Bv1W" crossorigin="anonymous"></script>
</body>
</html>