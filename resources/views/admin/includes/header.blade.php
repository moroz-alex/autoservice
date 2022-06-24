<h1 class="mt-4">@yield('header')</h1>
<ol class="breadcrumb mb-4 float-sm-right">
    <li class="breadcrumb-item"><a href="#">Главная</a></li>
    @yield('breadcrumb_subcat')
    <li class="breadcrumb-item active">@yield('breadcrumb')</li>
</ol>
