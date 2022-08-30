<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link {{ request()->routeIs('user.orders.index') ? 'active' : '' }}" href="{{ route('user.orders.index') }}">
                <div class="sb-nav-link-icon text-center" style="width: 1em"><i class="fa-solid fa-clipboard-list"></i></div>
                Заказы
            </a>
            <a class="nav-link {{ request()->routeIs('user.cars.index') ? 'active' : '' }}" href="{{ route('user.cars.index') }}">
                <div class="sb-nav-link-icon text-center" style="width: 1em"><i class="fa-solid fa-car"></i></div>
                Авто
            </a>
            <a class="nav-link {{ request()->routeIs('user.show') ? 'active' : '' }}" href="{{ route('user.show') }}">
                <div class="sb-nav-link-icon text-center" style="width: 1em"><i class="fa-solid fa-calendar-days"></i></div>
                Клиент
            </a>
        </div>
    </div>
</nav>
