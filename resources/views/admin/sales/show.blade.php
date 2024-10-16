@extends('layouts.app')
@section('content')

<div class="container-fluid d-flex">
    @auth
        @include('admin.partials.aside')
    @endauth
    <div class="container-fluid">
        <h1 class="my-4">Dettagli piatto</h1>

        <ul>
            <h3 class="my-4">ID Ordine: {{ $sale->id }}</h3>
            
            <h4 class="my-4">Dettagli</h4>
            <ul class="list-group list-group-flush my-3">
                <li class="list-group-item">{{ $sale->full_name }}</li>
                <li class="list-group-item">{{ $sale->email }}</li>
                <li class="list-group-item">{{ $sale->address}}</li>
                <li class="list-group-item">{{ $sale->total_price}}&euro;</li>
                <li class="list-group-item">{{ $sale->phone_number}}</li>
            </ul>
        </ul>
    </div>
</div>


@endsection