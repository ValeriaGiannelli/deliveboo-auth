@section('titlePage')
    Home
@endsection

@extends('layouts.app')
@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            @auth
                @include('admin.partials.aside')
            @endauth
            <div class="col-sm col-12 my-3" id="dashboard">
                <div class="info">
                    <h1>Benvenuto nel tuo ristorante</h1>
                    <div class="mb-3">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4">
                                <img src="{{ $restaurant->img ? asset('storage/' . $restaurant->img) : asset('storage/uploads/no_img.jpg') }}"
                                    class="img-fluid rounded-start" alt="{{ $restaurant->name }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title title">{{ $restaurant->restaurant_name }}</h5>
                                    <p class="card-text">Indirizzo: {{ $restaurant->restaurant_name }} | P.iva:
                                        {{ $restaurant->piva }} </p>
                                    <p class="card-text"><small
                                            class="text-muted">{{ $restaurant->description ?? 'Nessuna descrizione disponibile.' }}</small>
                                    </p>
                                    <div">
                                        <a class="btn btn-warning text-secondary" href="http://localhost:5174/">Vai al
                                            sito</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col ">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-warning text-secondary">Gestione
                            menu</a>
                        <a href="{{ route('admin.sales.index') }}" class="btn btn-warning text-secondary">Gestione
                            ordini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
