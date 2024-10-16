@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" id="nameErrorLabel">{{ __('Name') }}</label>

                            <div class="col-md-6 ">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <div class="tooltip-error col" id="nameTooltip">Il Nome è obbligatorio e deve avere almeno 2 caratteri.</div>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" id="emailErrorLabel">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6 position-relative">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                {{-- Errori front-end --}}
                                <small class="text-danger" id="emailError"></small>

                                {{-- errori back-end --}}
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- Errori front-end --}}
                            <div class="col-md-6 position-relative">
                                <div class="tooltip-error col" id="emailTooltip">La mail è obbligatoria e deve rispttare i criteri.</div>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" id="passwordErrorLable">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                {{-- Errori front-end --}}
                                <small class="text-danger" id="passwordError"></small>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- Errori front-end --}}
                            <div class="col-md-6 position-relative">
                                <div class="tooltip-error col" id="passwordTooltip">La password deve avere almeno 8 caratteri e contenere una maiuscola,una minuscola e un carattere speciale.</div>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right" id="password-confirmErrorLabel">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            {{-- Errori front-end --}}
                            <small class="text-danger" id="password-confirmError"></small>

                            {{-- Errori front-end --}}
                            <div class="col-md-6 position-relative">
                                <div class="tooltip-error col" id="password-confirmTooltip">Le password devono corrispondere.</div>
                            </div>
                        </div>

                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="btn-register" disabled>
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
        //EMAIL
        const emailError = document.getElementById('emailError');
        const emailErrorLabel = document.getElementById('emailErrorLabel');
        const emailInput = document.getElementById('email').value;
        //PASSWORD
        const passwordError = document.getElementById('passwordError');
        const passwordErrorLabel = document.getElementById('passwordErrorLabel');
        const passwordInput = document.getElementById('password').value;
        //PASSWORD-CONFIRM
        const passwordConfirmError = document.getElementById('password-confirmError');
        const passwordConfirmErrorLabel = document.getElementById('password-confirmErrorLabel');
        const passwordConfirmInput = document.getElementById('password').value;

        // validazione nome
        if (nameInput.length < 2) {
            //NAME
            nameError.innerHTML = "Il Nome deve avere almeno due caratteri.";
            nameErrorLabel.style = "color:red";
            nameInput.style = "border-color:red";
            valid = false;

        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput)) {
            //EMAIL CON REGEX @ E .
            emailError.innerHTML = "L'indirizzo email deve essere un formato valido.";
            emailErrorLabel.style = "color:red";
            emailInput.style = "border-color:red";
            valid = false;
        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(passwordInput)) {
            //ADDRESS
            passwordError.innerHTML = "La partita iva deve avere 11 caratteri.";
            passwordErrorLabel.style = "color:red";
            passwordInput.style = "border-color:red";
            valid = false;
        } else if (passwordInput !== passwordConfirmInput) {
            //ADDRESS
            passwordConfirmError.innerHTML = "La partita iva deve avere 11 caratteri.";
            passwordConfirmErrorLabel.style = "color:red";
            passwordConfirmInput.style = "border-color:red";
            valid = false;
        }
        return valid;
    }


    //Listener per i campi
    document.getElementById('name').addEventListener('input', checkForm);
    document.getElementById('email').addEventListener('input', checkForm);
    document.getElementById('password').addEventListener('input', checkForm);
    document.getElementById('password-confirm').addEventListener('input', checkForm);

    //Check campi
    function checkForm() {
        let validName = false;
        let validEmail = false;
        let validPswd = false;
        let validPswdConfirm = false;

        // let validTypes = true;
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('password-confirm').value;
        const nameTooltip = document.getElementById('nameTooltip');
        const emailTooltip = document.getElementById('emailTooltip');
        const passwordTooltip = document.getElementById('passwordTooltip');
        const passwordConfirmTooltip = document.getElementById('password-confirmTooltip');



        //controllo campo nome
        if (name.length >= 0 && name.length < 2) {
            nameTooltip.classList.add('visible');
            validName = false;
        } else {
            validName = true;
            nameTooltip.classList.remove('visible');
        }
        //Controllo indirizzo
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            emailTooltip.classList.add('visible');
            validEmail = false;
        } else {
            validEmail = true;
            emailTooltip.classList.remove('visible');

        }
        // Controllo Password
        if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(password)) {
            passwordTooltip.classList.add('visible');
            validPswd = false;
        } else {
            validPswd = true;
            passwordTooltip.classList.remove('visible');
        }
        // Controllo Password di conferma
        if (passwordConfirm !== password) {
            passwordConfirmTooltip.classList.add('visible');
            validPswdConfirm = false;
        } else {
            validPswdConfirm = true;
            passwordConfirmTooltip.classList.remove('visible');
        }
        //Bottone
        if (validName && validEmail && validPswd && validPswdConfirm) {
            document.getElementById('btn-register').disabled = false;
        } else {
            document.getElementById('btn-register').disabled = true;
        }

    }

    // funzione che cambia l'anteprima del file caricato
    function showImg(event) {
        const thumb = document.getElementById('thumb');
        thumb.src = URL.createObjectURL(event.target.files[0]);
    }
</script>


@endsection
