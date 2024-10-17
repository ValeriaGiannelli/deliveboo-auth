@extends('layouts.app')
@section('content')
    <div class="container-fluid d-flex my-4">
        @auth
            @include('admin.partials.aside')
        @endauth
        @if (count($products))
            <div class="container-fluid my-3">
                <a href="{{ route('admin.products.create') }}" class="btn btn-warning ms-5 my-3">Aggiungi Nuovo Piatto</a>

                <table class="table ms-5">
                    <thead>
                        <tr>
                            <th scope="col">Nome Piatto</th>
                            <th scope="col">Ingredienti/descrizione</th>
                            <th scope="col">Immagine</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col">Disponibile</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->ingredients_descriptions }}</td>
                                <td><img class="thumb-mini" src="{{ asset('storage/' . $product->img) }}"  alt="{{ $product->name }}"
                                    onerror="this.src='{{ asset('storage/uploads/no_img.jpg') }}'"></td>
                                <td>{{ $product->price }}&euro;</td>
                                <td>{{ $product->visible? 'Si' : 'No' }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{route('admin.products.edit', $product)}}">
                                            Modifica
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Sei sicuro di voler eliminare questo prodotto?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Elimina</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h2>Non ci sono prodotti</h2>

            <div class="container-fluid my-5">
                <a href="{{ route('admin.products.create') }}" class="btn btn-warning d-block">Aggiungi Nuovo Piatto</a>
            </div>
        @endif
    </div>
    
@endsection

{{-- <img src="{{ asset('storage/' . $product->img) }}" class="card-img-top" alt="{{ $product->name }}"
                                onerror="this.src='{{ asset('storage/uploads/no_img.jpg') }}'"> --}}
