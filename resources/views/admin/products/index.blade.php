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
                        <div class="col-2">
                            @if ($product->visible)
                                <div class="card">
                            @else
                                <div class="card hidden">
                            @endif
                                <img src="{{asset('storage/' .  $product->img) }}" class="card-img-top" alt="{{ $product->name }}" onerror="this.src='{{asset('storage/uploads/no_img.jpg')}}'">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="card-info">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">
                                            {{ $product->ingredients_descriptions }}
                                        </p>
                                        <p>
                                            Prezzo: {{ $product->price }}&euro;
                                        </p>
                                        <p>
                                            Mostra: {!! $product->visible ? '<span class="text-success">SI</span>' : '<span class="text-danger">NO</span>' !!}

                                        </p>
                                    </div>
                                    <div class="buttons">
                                        <a class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('admin.products.show', $product) }}"class="btn btn-primary"><i class="fa-solid fa-info"></i></a>
                                        <a href="{{route('admin.products.edit', $product)}}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo prodotto?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></i></button>
                                        </form>
                                    </div>
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
