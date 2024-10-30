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
                            <div class="col-md-4 position-relative me-3" style="width: 500px; aspect-ratio: 16/9;">
                                <img src="{{ $restaurant->img ? asset('storage/' . $restaurant->img) : asset('storage/uploads/no_img.jpg') }}"
                                    class="rounded-start object-fit-contain w-100 h-100" alt="{{ $restaurant->name }}">
                            </div>
                            <div class="col-md">
                                <div class="card-body">
                                    <h5 class="card-title title">{{ $restaurant->restaurant_name }}</h5>
                                    <p class="card-text">Indirizzo: {{ $restaurant->restaurant_name }} | P.iva:
                                        {{ $restaurant->piva }} </p>
                                    <p class="card-text"><small
                                            class="text-muted">{{ $restaurant->description ?? 'Nessuna descrizione disponibile.' }}</small>
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-warning text-secondary mb-2">Gestione
                            menu</a>
                        <a href="{{ route('admin.sales.index') }}" class="btn btn-warning text-secondary mb-2">Gestione
                            ordini</a>
                        <a class="btn btn-warning text-secondary mb-2" href="http://localhost:5174/">Vai al
                            sito</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
