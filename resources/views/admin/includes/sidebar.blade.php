<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
{{--            <a class="nav-link" href="#">--}}
{{--                <div class="sb-nav-link-icon" style="width: 1em"><i class="fas fa-tachometer-alt"></i></div>--}}
{{--                Панель--}}
{{--            </a>--}}
            <a class="nav-link" href="{{ route('admin.schedules.index') }}">
                <div class="sb-nav-link-icon text-center" style="width: 1em"><i class="fa-solid fa-calendar-days"></i></div>
                Расписание
            </a>
            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                <div class="sb-nav-link-icon text-center" style="width: 1em"><i class="fa-solid fa-clipboard-list"></i></div>
                Заказы
            </a>
            <a class="nav-link" href="{{ route('admin.tasks.index') }}">
                <div class="sb-nav-link-icon text-center" style="width: 1em"><i class="fa-solid fa-wrench"></i></div>
                Работы
            </a>
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                <div class="sb-nav-link-icon text-center" style="width: 1em"><i class="fa-solid fa-table-list"></i></div>
                Категории работ
            </a>
            <a class="nav-link" href="{{ route('admin.masters.index') }}">
                <div class="sb-nav-link-icon text-center" style="width: 1em"><i class="fa-solid fa-digging"></i></div>
                Мастера
            </a>
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <div class="sb-nav-link-icon text-center" style="width: 1em"><i class="fa-solid fa-users"></i></div>
                Пользователи
            </a>
            <a class="nav-link" href="{{ route('admin.brands.index') }}">
                <div class="sb-nav-link-icon text-center" style="width: 1em"><i class="fa-solid fa-car"></i></div>
                Марки и модели авто
            </a>
            <a class="nav-link" href="{{ route('admin.settings.edit') }}">
                <div class="sb-nav-link-icon text-center" style="width: 1em"><i class="fa-solid fa-gear"></i></div>
                Настройки
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Вы вошли как:</div>
        {{ auth()->user()->name . ' ' . auth()->user()->last_name }}
    </div>
</nav>
