@section('titlePage')
    Ordini
@endsection

@extends('layouts.app')
@section('content')
    <div class="container-fluid d-flex my-4">
        <div class="row w-100">
            @auth
                @include('admin.partials.aside')
            @endauth
            <div class="col-sm col-12 my-3">
                <h1 class="text-center my-3">Lista Ordini</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID Ordine</th>
                            <th scope="col">Nome</th>
                            <th scope="col" class="d-none d-lg-table-cell">Email</th>
                            <th scope="col" class="d-none d-lg-table-cell">Indirizzo</th>
                            <th scope="col">Prezzo Totale</th>
                            <th scope="col" class="d-none d-lg-table-cell">Telefono</th>
                            <th scope="col">Effettuato</th>
                            <th scope="col">Visualizza</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ $sale->full_name }}</td>
                                <td class="d-none d-lg-table-cell">{{ $sale->email }}</td>
                                <td class="d-none d-lg-table-cell">{{ $sale->address }}</td>
                                <td>{{ $sale->total_price }}&euro;</td>
                                <td class="d-none d-lg-table-cell">{{ $sale->phone_number }}</td>
                                <td>{{ $sale->created_at->format('d-m-Y H:i') }}</td>
                                <td><a href="{{ route('admin.sales.show', $sale) }}" class="btn btn-primary"><i class="fas fa-eye"></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
