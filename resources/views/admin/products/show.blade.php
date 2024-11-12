@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dettagli piatto</h1>

        {{-- dettaglio del piatto --}}
        <ul class="list-group list-unstyled">
            <h3>Nome: {{ $product->name }}</h3>
            <li>Ingredienti/Descrizione: {{ $product->ingredients_descriptions }}</li>
            <li>
                <div class="container mb-5">
                    <img class="img-fluid" alt="{{ $product->name }}" src="{{ asset('storage/' . $product->img) }}"
                        onerror="this.src='{{ asset('storage/uploads/no_img.jpg') }}'">
                </div>
            </li>
            <li>Prezzo: {{ $product->price }}</li>
            <li> Mostra: {!! $product->visible ? '<span class="text-success">SI</span>' : '<span class="text-danger">NO</span>' !!}</li>
        </ul>

        {{-- tasto per la modifica --}}
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary">Modifica</a>

        {{-- tasto elimina --}}
        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
            onsubmit="return confirm('Sei sicuro di voler eliminare questo prodotto?');" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina</button>
        </form>

        {{-- tasto per tornare all'elenco dei piatti --}}
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Torna all'elenco dei piatti</a>
    </div>
@endsection
