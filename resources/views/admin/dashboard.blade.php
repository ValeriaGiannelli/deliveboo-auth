@extends('layouts.app')
@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-2">
                @auth
                    @include('admin.partials.aside')
                @endauth
            </div>
            <div class="col-10" id="dashboard">
                <div class="info">
                    <h1>Benvenuto nel tuo ristorante: {{ $restaurant }}</h1>

                    <h2 class="fs-4 text-secondary my-4">
                        Benvenuto nella pagina di gestione del tuo ristorante
                    </h2>
                    <div class="row justify-content-center">
                        <div class="col">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-warning">Gestione menu</a>
                            <a href="{{ route('admin.sales.index') }}" class="btn btn-warning">Gestione ordini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
