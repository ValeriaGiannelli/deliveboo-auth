<div class="col-12 col-sm-auto aside-container">
    <aside class="my-3 bord">
        <ul class="list-group list-unstyled d-flex flex-sm-column flex-row justify-content-between">
            <li class="{{ Route::is('admin.restaurants.index') ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="fas fa-home"></i>
                    <span class="nav-text ms-2 d-none d-xl-inline">Home</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.products.index') ? 'active' : '' }}">
                <a href="{{ route('admin.products.index') }}">
                    <i class="fas fa-utensils"></i>
                    <span class="nav-text ms-2 d-none d-xl-inline">Menu</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.products.create') ? 'active' : '' }}">
                <a href="{{ route('admin.products.create') }}">
                    <i class="fas fa-plus"></i>
                    <span class="nav-text ms-2 d-none d-xl-inline">Aggiungi piatti</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.sales.index') ? 'active' : '' }}">
                <a href="{{ route('admin.sales.index') }}">
                    <i class="fas fa-receipt"></i>
                    <span class="nav-text ms-2 d-none d-xl-inline">Gestione Ordini</span>
                </a>
            </li>

            {{-- STATISTICHE --}}
            <li class="{{ Route::is('admin.stats') ? 'active' : '' }}">
                <a href="{{ route('admin.stats') }}">
                    <i class="fas fa-chart-area"></i>
                    <span class="nav-text ms-2 d-none d-xl-inline">Statistiche</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
