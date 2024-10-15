@extends('layouts.app')

@section('content')
    <h1>Dettagli piatto</h1>
    <div>
        {{-- @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif --}}
        <a href="#" class="btn btn-secondary">Modifica</a>
        {{-- @include('admin.partials.formdelete', [
                            'route' => route('admin.posts.destroy', $post),
                            'message' => "Confermi l\'eliminazione del post: $post->title ?"
                            ]) --}}
    </div>
    <ul>
        <h3>Nome: {{ $products->name }}</h3>
        <li>Ingredienti/Descrizione: {{ $products->ingredients_descriptions }}</li>
        <li> 
            <div class="container mb-5">
                <img
                class="img-fluid"
                alt="{{ $products->img}}"
                src="">
            </div>
        </li>
        <li>Prezzo: {{ $products->price }}</li>
        <li>Viisibile al clientte : {{ $products->price }}</li>
    </ul>

    <a href="#" class="btn btn-primary">Torna all'elenco dei piatti</a>

@endsection
