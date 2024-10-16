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

            <form class="row g-3" action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data"
                onsubmit="return validateForm()">
                @csrf
                <div class="col-md-6">
                    <label for="name" class="form-label" id="nameErrorLabel">Nome del ristorante (*)</label>
                    <input type="text" class="form-control {{-- @error('name') is-invalid @enderror --}}" id="name" name="name"
                        placeholder="Scrivi il nome del ristorante" value="{{ old('name') }}" required>
                    {{-- Errori front-office --}}
                    <div class="tooltip-error" id="nameTooltip">Il Nome del ristorante è obbligatorio e deve avere almeno 2
                        caratteri.</div>
                    <small class="text-danger" id="nameError"></small>
                    {{-- Errorri back-office --}}
                    {{-- se esiste l'errore name stampa un messaggio anche sotto l'input --}}
                    {{-- @error('name')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror --}}

                </div>

                <div class="col-md-6">
                    <label for="address" class="form-label">Indirizzo (*)</label>
                    <input type="text" class="form-control {{-- @error('address') is-invalid @enderror --}}" id="address" name="address"
                        placeholder="Inserisci l'indirizzo" value="{{ old('address') }}" required>

                    {{-- @error('address')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror --}}
                </div>
                <div class="col-md-6">
                    <label for="piva" class="form-label">P.Iva (11 caratteri)</label>
                    <input type="text" class="form-control {{-- @error('piva') is-invalid @enderror --}}" id="piva" name="piva"
                        placeholder="Inserisci la tua P.Iva" value="{{ old('piva') }}" required pattern="\d{11}">

                    {{-- @error('piva')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror --}}
                </div>

                {{-- caricamento img --}}
                <div class="col-12">
                    <label for="img" class="form-label">Immagine</label>
                    <input type="file" name="img" id="img" class="form-control" onchange="showImg(event)"
                        required>

                    {{-- anteprima dell'immagine caricata --}}
                    {{-- <img src="/img/no_img.jpg" class="thumb-mini" id="thumb"> --}}
                </div>
                {{-- @error('img')
                <small class="text-danger"> {{ $message }} </small>
            @enderror --}}

                <div class="col-12">
                    <label for="description" class="form-label">Descrizione del ristorante</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                        placeholder="Descrivi il tuo ristorante" required>{{ old('description') }}</textarea>
                </div>

                {{-- chechbox per le Tipologia di ristorante --}}
                <label for="types" class="form-label">Tipologia di ristorante: (*)</label>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($types as $type)
                        <input name="types[]" value="{{ $type->id }}" type="checkbox" class="btn-check"
                            id="type-{{ $type->id }}" autocomplete="off"
                            @if (in_array($type->id, old('types', []))) checked @endif>
                        <label class="btn btn-outline-primary" for="type-{{ $type->id }}">{{ $type->name }}</label>
                    @endforeach

                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Invia</button>
                </div>
                <div class="col-12">
                    <button type="reset" class="btn btn-primary">Cancella</button>
                </div>
            </form>
        </div>

        {{-- funzioni --}}
        <script>
            //VALIDAZIONE FORM
            function validateForm() {
                let valid = true;
                //prendo elementi in pagina
                const nameError = document.getElementById('nameError');
                const nameErrorLabel = document.getElementById('nameErrorLabel');
                const nameInput = document.getElementById('name');

                // validazione nome
                const name = document.getElementById('name').value;
                if (name.length < 2) {
                    nameError.innerHTML = "Il Nome del ristorante deve avere almeno due caratteri.";
                    nameErrorLabel.style = "color:red";
                    nameInput.style = "border-color:red";
                    valid = false;
                }

                return valid;
            }
            //Listener per i campi
            document.getElementById('name').addEventListener('input', checkForm);
            //Check campi
            function checkForm() {
                let valid = true;
                const name = document.getElementById('name').value;
                const nameTooltip = document.getElementById('nameTooltip');


                //controllo campo nome
                if (name.length = 0) {
                    nameTooltip.classList.add('visible');
                    valid = false;
                }
                document.getElementById('submitBtn').disabled = !valid;
            }

            /* //Listener su click
            document.getElementById('name').addEventListener('input', checkInput);

            function checkInput() {
                let valid = true;
                const name = document.getElementById('name').value;
                const nameError = document.getElementById('nameError');

                //controllo campo nome
                if (!name.length > 0) {
                    nameError.innerHTML = "Il Nome del ristorante è obbligatorio";
                    valid = false;
                } else {
                    nameError.innerHTML = "";
                }
            } */


            // funzione che cambia l'anteprima del file caricato
            function showImg(event) {
                const thumb = document.getElementById('thumb');
                thumb.src = URL.createObjectURL(event.target.files[0]);
            }
        </script>
    @endsection
@else
    @section('content')
        <div class="container-fluid">
            @auth
                @include('admin.partials.aside')
            @endauth
            <div class="container hide" id="dashboard">
                <h1>Benvenuto nel tuo ristorante: {{ $restaurant }}</h1>

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
