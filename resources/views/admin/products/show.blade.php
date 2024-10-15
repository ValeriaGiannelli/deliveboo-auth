@extends('layouts.app')

@section('content')
    <h1>Dettagli piatto</h1>

    <ul>
        <h3>Nome: {{ $product->name }}</h3>
        <li>Ingredienti/Descrizione: {{ $product->ingredients_descriptions }}</li>
        <li>
            <div class="container mb-5">
                <img
                class="img-fluid"
                alt="{{ $product->name}}"
                src="{{$product->img}}">
            </div>
        </li>
        <li>Prezzo: {{ $product->price }}</li>
        <li> Mostra: {!! $product->visible ? '<span class="text-success">SI</span>' : '<span class="text-danger">NO</span>' !!}</li>
    </ul>

    <a href="#" class="btn btn-secondary">Modifica</a>
    <a href="{{route('admin.products.index')}}" class="btn btn-primary">Torna all'elenco dei piatti</a>

@endsection
