<!-- Navbar Brand-->
<a class="navbar-brand ps-3" href="{{ route('admin.orders.index') }}"><i class="fa-solid fa-car-side"></i> МойАвтосервис</a>
<!-- Sidebar Toggle-->
<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#"><i
        class="fas fa-bars"></i></button>
<!-- Navbar Search-->
<div class="d-none d-md-inline-block ms-auto ">
</div>
<!-- Navbar-->
<span class="text-white-50">{{ auth()->user()->name . ' ' . auth()->user()->last_name }}</span>
<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
           aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('admin.settings.edit') }}">Настройки</a></li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Выйти
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </li>
</ul>
