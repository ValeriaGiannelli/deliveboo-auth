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
                            <td><img class="thumb-mini" src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}"
                                    onerror="this.src='{{ asset('storage/uploads/no_img.jpg') }}'"></td>
                            <td>{{ $product->price }}&euro;</td>
                            <td>{{ $product->visible? 'Si' : 'No' }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{route('admin.products.edit', $product)}}">
                                    Modifica
                                </a>
                    
                                <!-- Trigger della Modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
                                    Elimina
                                </button>
                    
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel{{ $product->id }}">Eliminazione piatto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Sei sicuro di voler eliminare il piatto <strong>{{ $product->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form id="delete-product-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                                </form>
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Chiudi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <script>
        function deleteProduct(){
            document.getElementById("delete-product").submit();
        }
        
    </script>

    
@endsection

