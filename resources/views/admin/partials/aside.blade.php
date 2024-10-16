<aside class="my-3">
    <ul class="list-group navbar-nav">
        <li class="{{ Route::is('admin.restaurants.index') ? 'active' : '' }}">
            <a href="{{ route('home') }}"><span class="d-md-none d-lg-inline-block">Home</span></a>
        </li>
        <li class="{{ Route::is('admin.products.index') ? 'active' : '' }}">
            <a href="{{ route('admin.products.index') }}"><span class="d-md-none d-lg-inline-block">Menu</span></a>
        </li>
        <li class="{{ Route::is('admin.products.create') ? 'active' : '' }}">
            <a href="{{ route('admin.products.create') }}"><span class="d-md-none d-lg-inline-block">Aggiungi
                    piatti</span></a>
        </li>
        <li class="{{ Route::is('admin.sales.index') ? 'active' : '' }}">
            <a href="{{ route('admin.sales.index') }}"><span class="d-md-none d-lg-inline-block">Gestione
                    Ordini</span></a>
        </li>
    </ul>
</aside>
