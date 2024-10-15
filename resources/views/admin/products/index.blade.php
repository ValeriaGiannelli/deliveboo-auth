@extends('layouts.app')
@section('content')
    <div class="container-fluid d-flex">
        @auth
            @include('admin.partials.aside')
        @endauth
        <div class="container-fluid">
            <div class="row">

                @if (count($products))
                    @foreach ($products as $product)
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ $product->img }}" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">
                                        {{ $product->ingredients_descriptions }}
                                    </p>
                                    <p>
                                        Prezzo: {{ $product->price }}&euro;
                                    </p>
                                    <p>
                                        Mostra: {!! $product->visible ? '<span class="text-success">SI</span>' : '<span class="text-danger">SI</span>' !!}

                                    </p>
                                    <a href="{{route('admin.products.show', $product)}}" class="btn btn-primary">Dettagli</a>
                                    <a href="#" class="btn btn-warning">Modifica</a>
                                    <a href="#" class="btn btn-danger">Elimina</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2>Non ci sono prodotti</h2>
                @endif
            </div>
        </div>
    </div>
@endsection
