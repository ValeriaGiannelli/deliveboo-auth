@extends('layouts.app')

@if (!$restaurant)
    @section('form')
        <div class="container my-5">
            <h1>Registra il tuo nuovo ristorante</h1>
            {{-- se ci sono gli errori stampa un messaggi con gli errori --}}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- Name --}}
            <form class="row g-3" action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data"
                onsubmit="return validateForm()">
                @csrf
                <div class="col-md-6 position-relative">
                    <label for="name" class="form-label " id="nameErrorLabel">Nome del ristorante
                        (*)</label>
                    <input type="text" class="form-control {{-- @error('name') is-invalid @enderror --}}" id="name" name="name"
                        placeholder="Scrivi il nome del ristorante" value="{{ old('name') }}" required>
                    {{-- Errori front-office --}}
                    <div class="tooltip-error col" id="nameTooltip">Il Nome del ristorante è obbligatorio e deve avere
                        almeno 2
                        caratteri.</div>
                    <small class="text-danger" id="nameError"></small>
                    {{-- Errorri back-office --}}
                    {{-- se esiste l'errore name stampa un messaggio anche sotto l'input --}}
                    @error('name')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror

                </div>
                {{-- Address --}}
                <div class="col-md-6 position-relative">
                    <label for="address" class="form-label" id="addressErrorLabel">Indirizzo (*)</label>
                    <input type="text" class="form-control {{-- @error('address') is-invalid @enderror --}}" id="address" name="address"
                        placeholder="Inserisci l'indirizzo" value="{{ old('address') }}" required>
                    {{-- Errori front-office --}}
                    <div class="tooltip-error" id="addressTooltip">L'indirizzo del ristorante è obbligatorio e deve avere
                        almeno
                        5
                        caratteri.</div>
                    <small class="text-danger" id="addressError"></small>
                    {{-- @error('address')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror --}}
                </div>
                {{-- Piva --}}
                <div class="col-md-6 position-relative">
                    <label for="piva" class="form-label" id="pivaErrorLabel">P.Iva (11 caratteri)</label>
                    <input type="text" class="form-control {{-- @error('piva') is-invalid @enderror --}}" id="piva" name="piva"
                        placeholder="Inserisci la tua P.Iva" value="{{ old('piva') }}" required pattern="\d{11}">
                    {{-- Errori front-office --}}
                    <div class="tooltip-error" id="pivaTooltip">La P.iva del ristorante è obbligatoria e deve avere 11
                        caratteri.</div>
                    <small class="text-danger" id="pivaError"></small>
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

                {{-- Descrizione --}}
                <div class="col-12">
                    <label for="description" class="form-label">Descrizione del ristorante</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                        placeholder="Descrivi il tuo ristorante" required>{{ old('description') }}</textarea>
                </div>

                {{-- chechbox per le Tipologia di ristorante --}}
                <label for="types" class="form-label">Tipologia di ristorante: (*)</label>
                <div class="btn-group d-flex flex-wrap" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($types as $type)
                        <input name="types[]" value="{{ $type->id }}" type="checkbox" class="btn-check"
                            id="type-{{ $type->id }}" autocomplete="off"
                            @if (in_array($type->id, old('types', []))) checked @endif>
                        <label class="btn btn-outline-primary" for="type-{{ $type->id }}">{{ $type->name }}</label>
                        <small class="text-danger" name="typesError"></small>
                    @endforeach
                </div>
                {{-- Bottoni --}}
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
                //NAME
                const nameError = document.getElementById('nameError');
                const nameErrorLabel = document.getElementById('nameErrorLabel');
                const nameInput = document.getElementById('name').value;
                //ADDRESS
                const addressError = document.getElementById('addressError');
                const addressErrorLabel = document.getElementById('addressErrorLabel');
                const addressInput = document.getElementById('address').value;
                //PIVA
                const pivaError = document.getElementById('pivaError');
                const pivaErrorLabel = document.getElementById('pivaErrorLabel');
                const pivaInput = document.getElementById('piva').value;

                // validazione nome
                if (nameInput.length < 2) {
                    //NAME
                    nameError.innerHTML = "Il Nome del ristorante deve avere almeno due caratteri.";
                    nameErrorLabel.style = "color:red";
                    nameInput.style = "border-color:red";
                    valid = false;

                } else if (addressInput.length < 5) {
                    //ADDRESS
                    addressError.innerHTML = "L'indirizzo del ristorante deve avere almeno cinque caratteri.";
                    addressErrorLabel.style = "color:red";
                    addressInput.style = "border-color:red";
                    valid = false;
                } else if (pivaInput.length != 11) {
                    //ADDRESS
                    pivaError.innerHTML = "La partita iva deve avere 11 caratteri.";
                    pivaErrorLabel.style = "color:red";
                    pivaInput.style = "border-color:red";
                    valid = false;
                }
                return valid;
            }


            //Listener per i campi
            document.getElementById('name').addEventListener('input', checkForm);
            document.getElementById('address').addEventListener('input', checkForm);
            document.getElementById('piva').addEventListener('input', checkForm);

            //Check campi
            function checkForm() {
                let validName = false;
                let validAddress = false;
                let validPiva = false;
                let validTypes = true;
                const name = document.getElementById('name').value;
                const address = document.getElementById('address').value;
                const piva = document.getElementById('piva').value;
                const nameTooltip = document.getElementById('nameTooltip');
                const addressTooltip = document.getElementById('addressTooltip');
                const pivaTooltip = document.getElementById('pivaTooltip');



                //controllo campo nome
                if (name.length >= 0 && name.length < 2) {
                    nameTooltip.classList.add('visible');
                    validName = false;
                } else {
                    validName = true;
                    nameTooltip.classList.remove('visible');
                }
                //Controllo indirizzo
                if (address.length >= 0 && address.length < 5) {
                    addressTooltip.classList.add('visible');
                    validAddress = false;
                } else {
                    validAddress = true;
                    addressTooltip.classList.remove('visible');

                }
                //Controllo Piva
                if (piva.length >= 0 && piva.length != 11) {
                    pivaTooltip.classList.add('visible');
                    validPiva = false;
                } else {
                    validPiva = true;
                    pivaTooltip.classList.remove('visible');
                }
                //Bottone
                if (validName && validAddress && validPiva) {
                    document.getElementById('submitBtn').disabled = false;
                } else {
                    document.getElementById('submitBtn').disabled = true;
                }

            }

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
