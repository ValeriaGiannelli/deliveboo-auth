@extends('layouts.app')

@if (!$restaurant)
    @section('form')
        <div class="container my-5">
            <h1>Registra il tuo nuovo ristorante</h1>
            {{-- se ci sono gli errori stampa un messaggi con gli errori --}}
            {{-- @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

            <form class="row g-3" action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="name" class="form-label">Nome del ristorante (*)</label>
                    <input type="text" class="form-control {{-- @error('name') is-invalid @enderror --}}" id="name" name="name"
                        placeholder="Scrivi il nome del ristorante" value="{{ old('name') }}">
                    {{-- se esiste l'errore name stampa un messaggio anche sotto l'input --}}
                    {{-- @error('name')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror --}}

                </div>

                <div class="col-md-6">
                    <label for="address" class="form-label">Indirizzo (*)</label>
                    <input type="text" class="form-control {{-- @error('address') is-invalid @enderror --}}" id="address" name="address"
                        placeholder="Inserisci l'indirizzo" value="{{ old('address') }}">

                    {{-- @error('address')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror --}}
                </div>
                <div class="col-md-6">
                    <label for="piva" class="form-label">P.Iva (*)</label>
                    <input type="text" class="form-control {{-- @error('piva') is-invalid @enderror --}}" id="piva" name="piva"
                        placeholder="Inserisci la tua P.Iva" value="{{ old('piva') }}">

                    {{-- @error('piva')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror --}}
                </div>

                {{-- caricamento img --}}
                <div class="col-12">
                    <label for="img" class="form-label">Immagine</label>
                    <input type="file" name="img" id="img" class="form-control" onchange="showImg(event)">

                    {{-- anteprima dell'immagine caricata --}}
                    {{-- <img src="/img/no_img.jpg" class="thumb-mini" id="thumb"> --}}
                </div>
                {{-- @error('img')
                <small class="text-danger"> {{ $message }} </small>
            @enderror --}}

                <div class="col-12">
                    <label for="description" class="form-label">Descrizione del ristorante</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                        placeholder="Descrivi il tuo ristorante">{{ old('description') }}</textarea>
                </div>

                {{-- chechbox per le tecnologie --}}
                {{--  <label for="technologies" class="form-label">Tecnologie: (*)</label>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ($technologies as $technology)
                    <input name="technologies[]" value="{{ $technology->id }}" type="checkbox" class="btn-check"
                        id="tech-{{ $technology->id }}" autocomplete="off" @if (in_array($technology->id, old('technologies', []))) checked @endif>
                    <label class="btn btn-outline-primary"
                        for="tech-{{ $technology->id }}">{{ $technology->name }}</label>
                @endforeach

            </div> --}}
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Invia</button>
                </div>
                <div class="col-12">
                    <button type="reset" class="btn btn-primary">Cancella</button>
                </div>
            </form>
        </div>

        {{-- funzioni --}}
        <script>
            // funzione che cambia l'anteprima del file caricato
            function showImg(event) {
                const thumb = document.getElementById('thumb');
                thumb.src = URL.createObjectURL(event.target.files[0]);
            }
        </script>
    @endsection
@else
    @section('content')
        <div class="container">
            <h1>Benvenuto nel tuo ristorante: {{ $restaurant }}</h1>
        </div>
        <div class="container-fluid d-flex">

            @auth
                @include('admin.partials.aside')
            @endauth
            <div class="container hide" id="dashboard">
                <h2 class="fs-4 text-secondary my-4">
                    Benvenuto nella pagina di gestione del tuo ristorante
                </h2>
                <div class="row justify-content-center">
                    <div class="col">
                        <a href="#" class="btn btn-warning">Gestione menu</a>
                        <a href="#" class="btn btn-warning">Gestione ordini</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif
