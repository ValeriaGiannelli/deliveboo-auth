@section('titlePage')
    Ordini
@endsection

@extends('layouts.app')
@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            @auth
                @include('admin.partials.aside')
            @endauth
            <div class="col-sm col-12 my-3">
                <h1 class="text-center my-3">Lista Ordini</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="d-none d-lg-table-cell">ID Ordine</th>
                            <th scope="col">Nome</th>
                            <th scope="col" class="d-none d-xl-table-cell">Telefono</th>
                            <th scope="col" class="d-none d-sm-table-cell">Data</th>
                            <th scope="col">Prezzo Totale</th>
                            <th scope="col">Visualizza</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td class="d-none d-lg-table-cell">{{ $sale->id }}</td>
                                <td>{{ $sale->full_name }}</td>
                                <td class="d-none d-xl-table-cell">{{ $sale->phone_number }}</td>
                                <td class="d-none d-sm-table-cell">{{ $sale->created_at->format('d-m-Y H:i') }}</td>
                                <td><strong style="font-weight: 600">{{ $sale->total_price }}&euro;</strong></td>
                                <td class="text-center"><a href="{{ route('admin.sales.show', $sale) }}"
                                        class="btn btn-primary"><i class="fas fa-eye"></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
