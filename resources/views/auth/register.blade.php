@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    {{-- se ci sono gli errori stampa un messaggi con gli errori --}}
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        {{-- FORM UTENTE --}}
                        <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm()"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"
                                    id="nameErrorLabel">{{ __('Name') }}</label>
                                {{-- NOME UTENTE --}}
                                <div class="col-md-6 ">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    {{-- Errori front-end --}}
                                    <small class="text-danger" id="nameError"></small>

                                    {{-- errori back-end --}}
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Errori front-end --}}
                                <div class="col-md-6 position-relative">
                                    <div class="tooltip-error col" id="nameTooltip">Il Nome è obbligatorio e deve avere
                                        almeno 2 caratteri.</div>
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"
                                    id="emailErrorLabel">{{ __('E-Mail Address') }}</label>
                                {{-- EMAIL --}}
                                <div class="col-md-6 position-relative">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email"
                                        oninput="this.value = this.value.toLowerCase()">
                                    {{-- Errori front-end --}}
                                    <small class="text-danger" id="emailError"></small>

                                    {{-- errori back-end --}}
                                    @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Errori front-end --}}
                                <div class="col-md-6 position-relative">
                                    <div class="tooltip-error col" id="emailTooltip">La mail è obbligatoria e deve rispttare
                                        i criteri.</div>
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"
                                    id="passwordErrorLable">{{ __('Password') }}</label>
                                {{-- PASSWORD --}}
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                     autocomplete="new-password">

                                    {{-- Errori front-end --}}
                                    <small class="text-danger" id="passwordError"></small>

                                    {{-- errori back-end --}}
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Errori front-end --}}
                                <div class="col-md-6 position-relative">
                                    <div class="tooltip-error col" id="passwordTooltip">La password deve avere almeno 8
                                        caratteri e contenere una maiuscola,una minuscola e un carattere speciale.</div>
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right"
                                    id="password-confirmErrorLabel">{{ __('Confirm Password') }}</label>

                                {{-- CONTROLLO PASSWORD --}}
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>
                                {{-- Errori front-end --}}
                                <small class="text-danger" id="password-confirmError"></small>

                                {{-- Errori front-end --}}
                                <div class="col-md-6 position-relative">
                                    <div class="tooltip-error col" id="password-confirmTooltip">Le password devono
                                        corrispondere.</div>
                                </div>
                            </div>

                            {{-- FORM RISTORANTE --}}

                            <div class="mb-4 row">
                                <label for="restaurant_name" class="col-md-4 col-form-label text-md-right" id="nameErrorLabelRestaurant">Nome del
                                    ristorante
                                    (*)</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="restaurant_name"
                                    name="restaurant_name" placeholder="Scrivi il nome del ristorante"
                                    value="{{ old('restaurant_name') }}">
                                </div>

                                <small class="text-danger" id="nameErrorRestaurant"></small>
                                {{-- Errori front-end --}}
                                <div class="col-md-6 position-relative">
                                    <div class="tooltip-error col" id="nameRestaurantTooltip">Il Nome del ristorante è
                                        obbligatorio e deve
                                        avere
                                        almeno 2
                                        caratteri.</div>
                                </div>

                                {{-- Errorri back-end --}}
                                {{-- se esiste l'errore name stampa un messaggio anche sotto l'input --}}
                                @error('restaurant_name')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror

                            </div>
                            {{-- Address --}}
                            <div class="mb-4 row">
                                <label for="address" class="col-md-4 col-form-label text-md-right" id="addressErrorLabel">Indirizzo (*)</label>

                                <div class="col-md-6 ">
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                        name="address" placeholder="Inserisci l'indirizzo" value="{{ old('address') }}"
                                    >
                                </div>

                                <small class="text-danger" id="addressError"></small>

                                {{-- Errori front-end --}}
                                <div class="col md-6 position-relative">
                                    <div class="tooltip-error" id="addressTooltip">L'indirizzo del ristorante è obbligatorio e
                                        deve avere
                                        almeno
                                        5
                                        caratteri.</div>

                                </div>

                                {{-- errori back-end --}}
                                @error('address')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror

                            </div>
                            {{-- Piva --}}
                            <div class="mb-4 row">
                                <label for="piva" class="col-md-4 col-form-label text-md-right" id="pivaErrorLabel">P.Iva (11 caratteri)
                                    (*)</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('piva') is-invalid @enderror" id="piva"
                                        name="piva" placeholder="Inserisci la tua P.Iva" value="{{ old('piva') }}"
                                     pattern="\d{11}">
                                </div>

                                <small class="text-danger" id="pivaError"></small>
                                {{-- Errori front-end --}}

                                <div class="col md-6 position-relative">
                                    <div class="tooltip-error" id="pivaTooltip">La P.iva del ristorante è obbligatoria e deve
                                        avere 11
                                        caratteri.</div>
                                </div>

                                {{-- errori back-end --}}
                                @error('piva')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>

                            {{-- caricamento img --}}
                            <div class="mb-4 row">
                                <label for="img" class="col-md-4 col-form-label text-md-right">Immagine (*)</label>

                                <div class="col-md-6">
                                    <input type="file" name="img" id="img" class="form-control" multiple
                                        accept="image/*">
                                </div>

                                {{-- Errori front-end --}}

                                <div class="col-md-6 position-relative">
                                    <div class="tooltip-error" id="imgTooltip">L'immagine è obbligatoria.</div>
                                </div>

                                {{-- anteprima dell'immagine caricata --}}
                                {{-- <img src="/img/no_img.jpg" class="thumb-mini" id="thumb"> --}}
                            </div>

                            {{-- errori back-end --}}
                            @error('img')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror

                            {{-- Descrizione --}}
                            <div class="mb-4 row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Descrizione del ristorante</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="5"
                                        placeholder="Descrivi il tuo ristorante">{{ old('description') }}</textarea>
                                </div>
                            </div>


                            {{-- Descrizione --}}
                            <div class="mb-4 row">
                                <label for="types" class="col-md-4 col-form-label text-md-right">Tipologia di ristorante: (*)</label>

                                <div class="col-md-6 d-flex flex-wrap">
                                    @foreach ($types as $type)
                                        <div class="form-check">
                                            <input name="types[]" value="{{ $type->id }}" type="checkbox" class="form-check-input"
                                                id="type-{{ $type->id }}" autocomplete="off"
                                                @if (in_array($type->id, old('types', []))) checked @endif>
                                            <label class="form-check-label me-3"
                                                for="type-{{ $type->id }}">{{ $type->name }}</label>
                                        </div>
                                    @endforeach

                                    <small class="text-danger" id="typesError" style="display:none">Seleziona almeno una
                                        tipologia di ristorante.</small>

                                    {{-- errori back-end --}}
                                    @error('types')
                                        <small class="text-danger"> {{ $message }} </small>
                                    @enderror
                                </div>

                            </div>


                            {{-- BOTTONI PER INVIO FORM
                            ******************************************************************************** --}}
                            <div class="col-12">

                                @if ($errors->any())
                                    <button type="submit" id="retry-button" class="btn btn-primary">Riprova</button>
                                @else
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Invia</button>
                                @endif
                            </div>
                            <div class="col-12">
                                <button type="reset" class="btn btn-primary">Cancella</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
