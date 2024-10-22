@section('titlePage')
    Menu
@endsection

@extends('layouts.app')
@section('content')
    <div class="container-fluid my-4">
        <div class="row w-100">
            @auth
                @include('admin.partials.aside')
            @endauth
            @if (count($products))
                <div class="col-sm-11 col-12 my-3">
                    @if(session('deleted'))
                        <div class="alert alert-success">
                            {{session('deleted')}}
                        </div>
                    @endif
                    <h4>
                        Nel tuo ristorante sono presenti {{ $count }} piatti
                    </h4>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-warning my-3">Aggiungi Nuovo Piatto</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="d-none d-sm-table-cell">Immagine</th>
                                    <th scope="col">Nome Piatto</th>
                                    <th scope="col" class="d-none d-md-table-cell">Prezzo</th>
                                    <th scope="col">Disponibile</th>
                                    <th scope="col">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="d-none d-sm-table-cell"><img class="thumb-mini"
                                                src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}"
                                                onerror="this.src='{{ asset('storage/uploads/no_img.jpg') }}'"></td>
                                        <td>{{ $product->name }}</td>
                                        <td class="d-none d-md-table-cell">{{ $product->price }}&euro;</td>
                                        <td>{{ $product->visible ? 'Si' : 'No' }}</td>
                                        <td>
                                            <a class="btn btn-warning" href="{{ route('admin.products.edit', $product) }}">
                                                <i class="fas fa-utensils"></i>

                                            </a>

                                            <!-- Trigger della Modal -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $product->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel{{ $product->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="exampleModalLabel{{ $product->id }}">
                                                                Eliminazione piatto</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Sei sicuro di voler eliminare il piatto
                                                            <strong>{{ $product->name }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form id="delete-product-{{ $product->id }}"
                                                                action="{{ route('admin.products.destroy', $product->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Elimina</button>
                                                            </form>
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-dismiss="modal">Chiudi</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$products->links()}}
                    </div>

                </div>
            @else
                <div class="col-8 col-sm-12 text-center">
                    <h2 class="text-center my-5">Non ci sono prodotti</h2>

                    <a href="{{ route('admin.products.create') }}" class="btn btn-warning">Aggiungi Nuovo Piatto</a>
                </div>
            @endif
        </div>

    </div>

    <script>
        function deleteProduct() {
            document.getElementById("delete-product").submit();
        }
    </script>


@endsection
