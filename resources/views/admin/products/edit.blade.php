{{-- questa view estende il file main.blade.php che è dentro la cartella view/layouts --}}
@extends('layouts.app')



@section('content')
<div class="container-fluid d-flex">
        @auth
            @include('admin.partials.aside')
        @endauth
    <div class="container my-5">

        {{-- se ci sono gli errori stampa un messaggi con gli errori --}}
        {{-- @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>

        @endif --}}

        <form class="row g-3" action="{{route('admin.products.update', $product)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-6">
            <label for="name" class="form-label">Nome del piatto (*)</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Scrivi il nome del piatto" value="{{old('name', $product->name)}}">
                {{-- se esiste l'errore title stampa un messaggio anche sotto l'input --}}
                {{-- @error('name')
                    <small class="text-danger"> {{$message}} </small>
                @enderror --}}

            </div>

            <div class="col-md-12">
                <label for="ingredients_descriptions" class="form-label">Ingredienti / Descrizione (*)</label>
                <input type="text" class="form-control @error('ingredients_descriptions') is-invalid @enderror" id="ingredients_descriptions" name="ingredients_descriptions" placeholder="Inserisci gli ingredienti e la descrizione del piatto" value="{{old('ingredients_descriptions', $product->ingredients_descriptions)}}">

                {{-- @error('ingredients_descriptions')
                    <small class="text-danger"> {{$message}} </small>
                @enderror --}}
            </div>

            {{-- caricamento img --}}
            <div class="col-12">
                <label for="img" class="form-label">Immagine prodotto (*)</label>
                <input type="file" name="img" id="img" class="form-control" onchange="showImg(event)">

                {{-- anteprima dell'immagine caricata --}}
                <img src="" class="thumb-mini" id="thumb">
            </div>
            {{-- @error('img')
                <small class="text-danger"> {{$message}} </small>
            @enderror --}}

            {{-- <img src="{{asset('storage/' . $product->img)}}" alt="{{ $product->name }}" onerror="this.src='/img/no_img.jpg'" class="thumb-mini" id="thumb"> --}}

            {{-- inserimento prezzo --}}
            <div class="col-md-3">
                <label for="price" class="form-label">Prezzo unitario (*)</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Inserisci gli ingredienti e la descrizione del piatto" value="{{old('price', $product->price)}}" step="0.01">

                {{-- @error('price')
                    <small class="text-danger"> {{$message}} </small>
                @enderror --}}
            </div>

            {{-- radio button per la visibilità --}}
            <div class="col-12">
                <label for="img" class="form-label">Prodotto visibile al pubblico: (*)</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="visible" name="visible" class="custom-control-input" value=1 @if($product->visible) checked @endif>
                    <label class="custom-control-label" for="visible">Sì</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="not_visible" name="visible" class="custom-control-input" value=0 @if(!$product->visible) checked @endif>
                    <label class="custom-control-label" for="not_visible">No</label>
                </div>

                {{-- @error('visible')
                    <small class="text-danger"> {{$message}} </small>
                @enderror --}}
            </div>


            {{-- bottoni --}}
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Invia</button>
            </div>
            <div class="col-12">
                <button type="reset" class="btn btn-primary">Cancella</button>
            </div>
        </form>
    </div>
</div>
{{-- funzioni --}}
<script>
    // funzione che cambia l'anteprima del file caricato
    function showImg(event){
        const thumb = document.getElementById('thumb');
        thumb.src = URL.createObjectURL(event.target.files[0]);
    }
</script>

@endsection
