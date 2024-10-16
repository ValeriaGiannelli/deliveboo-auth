@extends('layouts.app')
@section('content')

<div class="container-fluid d-flex">
    @auth
        @include('admin.partials.aside')
    @endauth
    <div class="container-fluid">
        <h1 class="my-4">Dettagli Ordine</h1>

        <h3 class="my-4">ID Ordine: {{ $sale->id }}</h3>
            
        <h4 class="my-4">Dettagli</h4>
        <ul class="list-group list-group-flush my-3">
            <li class="list-group-item"><span class="fw-bold">Nome: </span>{{ $sale->full_name }}</li>
            <li class="list-group-item"><span class="fw-bold">Email: </span>{{ $sale->email }}</li>
            <li class="list-group-item"><span class="fw-bold">Indirizzo: </span>{{ $sale->address}}</li>
            <li class="list-group-item"><span class="fw-bold">Totale Ordine: </span>{{ $sale->total_price}}&euro;</li>
            <li class="list-group-item"><span class="fw-bold">Numero di Telefono: </span>{{ $sale->phone_number}}</li>
            <li class="list-group-item"><span class="fw-bold">Effettuato il: </span>{{ $sale->created_at->format('d-m-Y H:i') }}</li>
        </ul>

        @if (count($sale->products))
        <h4 class="my-4">Piatti ordinati:</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Piatto</th>
                    <th scope="col">Prezzo Singolo</th>
                    <th scope="col">Quantità</th>
                    <th scope="col">Totale Quantità</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}&euro;</td>
                        <td>{{ $product->pivot->amount }}</td>
                        <td>{{ $product->pivot->price * $product->pivot->amount }}&euro;</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h4 class="my-4">Nessun piatto presente</h4>
        @endif
        
        <a href="{{route('admin.sales.index')}}" class="btn btn-primary">Torna all'elenco degli ordini</a>
    </div>
</div>


@endsection