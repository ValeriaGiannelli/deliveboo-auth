@extends('layouts.app')
@section('content')

<div class="container-fluid d-flex">
    @auth
        @include('admin.partials.aside')
    @endauth
    <div class="container-fluid">
        <h1 class="text-center my-3">Lista Ordini</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID Ordine</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Prezzo Totale</th>
                <th scope="col">Telefono</th>
                <th scope="col">Effettuato</th>
                <th scope="col">Visualizza</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->full_name }}</td>
                    <td>{{ $sale->email }}</td>
                    <td>{{ $sale->address }}</td>
                    <td>{{ $sale->total_price }}&euro;</td>
                    <td>{{ $sale->phone_number }}</td>
                    <td>{{ $sale->created_at->format('d-m-Y H:i') }}</td>
                    <td><a href="{{route('admin.sales.show', $sale) }}" class="btn btn-primary">Dettagli</a></td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>




@endsection