<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" />
    <link type="image/png" rel="icon" href="{{ asset('/favicon.png') }}">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    @yield('scriptTop')
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    @include('includes.navbar')
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('includes.sidebar')
    </div>
    <div id="layoutSidenav_content">
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('/js/scripts.js') }}"></script>
@yield('scriptBottom')
</body>
</html>
