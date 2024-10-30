@section('titlePage')
    Registrazione
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

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

                    <div class="card-body">
                        {{-- FORM UTENTE --}}
                        <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm()"
                            enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"
                                    id="nameErrorLabel">{{ __('Username (*)') }}</label>
                                {{-- NOME UTENTE --}}
                                <div class="col-md-6 ">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="Inserisci username">

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
                                    id="emailErrorLabel">{{ __('E-Mail Address (*)') }}</label>
                                {{-- EMAIL --}}
                                <div class="col-md-6 position-relative">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email"
                                        oninput="this.value = this.value.toLowerCase()" placeholder="Inserisci email">
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
                                    id="passwordErrorLable">{{ __('Password (*)') }}</label>
                                {{-- PASSWORD --}}
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Inserisci password">

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
                                    id="password-confirmErrorLabel">{{ __('Confirm Password (*)') }}</label>

                                {{-- CONTROLLO PASSWORD --}}
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
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
                                <label for="restaurant_name" class="col-md-4 col-form-label text-md-right"
                                    id="nameErrorLabelRestaurant">Nome del
                                    ristorante
                                    (*)</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="restaurant_name" name="restaurant_name"
                                        placeholder="Scrivi il nome del ristorante" value="{{ old('restaurant_name') }}"
                                        required>
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
                                <label for="address" class="col-md-4 col-form-label text-md-right"
                                    id="addressErrorLabel">Indirizzo (*)</label>

                                <div class="col-md-6 ">
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" placeholder="Inserisci l'indirizzo"
                                        value="{{ old('address') }}" required>
                                </div>

                                <small class="text-danger" id="addressError"></small>

                                {{-- Errori front-end --}}
                                <div class="col md-6 position-relative">
                                    <div class="tooltip-error" id="addressTooltip">L'indirizzo del ristorante è
                                        obbligatorio e
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
                                <label for="piva" class="col-md-4 col-form-label text-md-right"
                                    id="pivaErrorLabel">P.Iva (11 caratteri)
                                    (*)</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('piva') is-invalid @enderror"
                                        id="piva" name="piva" placeholder="Inserisci la tua P.Iva"
                                        value="{{ old('piva') }}" required pattern="\d{11}">
                                </div>

                                <small class="text-danger" id="pivaError"></small>
                                {{-- Errori front-end --}}

                                <div class="col md-6 position-relative">
                                    <div class="tooltip-error" id="pivaTooltip">La P.iva del ristorante è obbligatoria e
                                        deve
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
                                        accept="image/*" required>
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
                                <label for="description" class="col-md-4 col-form-label text-md-right">Descrizione del
                                    ristorante</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="5"
                                        placeholder="Descrivi il tuo ristorante">{{ old('description') }}</textarea>
                                </div>
                            </div>


                            {{-- Descrizione --}}
                            <div class="mb-4 row">
                                <label for="types" class="col-md-4 col-form-label text-md-right">Tipologia di
                                    ristorante: (*)</label>

                                <div class="col-md-6 d-flex flex-wrap">
                                    @foreach ($types as $type)
                                        <div class="form-check">
                                            <input name="types[]" value="{{ $type->id }}" type="checkbox"
                                                class="form-check-input" id="type-{{ $type->id }}"
                                                autocomplete="off" @if (in_array($type->id, old('types', []))) checked @endif>
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
                            {{-- Requisiti obbligatori --}}
                            <div class="mb-4 row">
                                <small>*campi obbligatori</small>
                            </div>


                            {{-- BOTTONI PER INVIO FORM
                            ******************************************************************************** --}}
                            <div class="col-12">

                                @if ($errors->any())
                                    <button type="submit" id="retry-button" class="btn btn-warning">Riprova</button>
                                @else
                                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Invia</button>
                                @endif
                                <button type="reset" class="btn btn-danger">Cancella</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- funzioni --}}
    {{-- SCRIPT INVIO FORMS --}}
    <script>
        {{-- funzioni --}}
        //VALIDAZIONE FORM
        function validateForm() {

            let valid = true;
            //prendo elementi in pagina
            //NAME User
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
            //NAME REStAURANT
            const nameErrorR = document.getElementById('nameErrorRestaurant');
            const nameErrorLabelR = document.getElementById('nameErrorLabelRestaurant');
            const nameInputR = document.getElementById('restaurant_name').value;
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
                //PASSWORD
                passwordError.innerHTML = "Formato non corretto";
                passwordErrorLabel.style = "color:red";
                passwordInput.style = "border-color:red";
                valid = false;
            } else if (passwordInput !== passwordConfirmInput) {
                //PASSWORD CONFIRM
                passwordConfirmError.innerHTML = "Formato non corretto CONFIRM";
                passwordConfirmErrorLabel.style = "color:red";
                passwordConfirmInput.style = "border-color:red";
                valid = false;
            } else if (nameInputR.length < 2) {
                //NAME
                nameErrorR.innerHTML = "Il Nome del ristorante deve avere almeno due caratteri.";
                nameErrorLabelR.style = "color:red";
                nameInputR.style = "border-color:red";
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
        document.getElementById('restaurant_name').addEventListener('input', checkFormRestaurantName);
        document.getElementById('address').addEventListener('input', checkFormRestaurantAddress);
        document.getElementById('piva').addEventListener('input', checkFormRestaurantPiva);
        document.getElementById('img').addEventListener('click', checkFormRestaurantImg);
        document.getElementById('img').addEventListener('input', checkFormRestaurantImg);
        //Listener per i campi
        document.getElementById('name').addEventListener('input', checkFormUserName);
        document.getElementById('email').addEventListener('input', checkFormUserEmail);
        document.getElementById('password').addEventListener('input', checkFormUserPassword);
        document.getElementById('password-confirm').addEventListener('input', checkFormUserPasswordConfirm);
        document.addEventListener('DOMContentLoaded', () => {
            const retryButton = document.getElementById('retry-button');
            if (retryButton) {
                retryButton.addEventListener('click', () => {
                    // Quando l'utente clicca su retry, vengono richiamate tutte le funzioni di validazione
                    checkFormUserPassword(); // Controllo della password
                    checkFormUserPasswordConfirm(); // Controllo della conferma password
                    checkFormRestaurantName(); // Controllo nome ristorante
                    checkFormRestaurantAddress(); // Controllo indirizzo ristorante
                    checkFormRestaurantPiva(); // Controllo PIVA
                    checkFormUserName(); // Controllo nome utente
                    checkFormUserEmail(); // Controllo email utente
                    buttonActivate(); // Riattivazione del pulsante se tutto è valido
                });
            } else {
                console.error('retry-button non trovato nel DOM');
            }
        });


        let validNameR;
        let validAddress;
        let validPiva;
        let validImg;
        let validName;
        let validEmail;
        let validPswd;
        let validPswdConfirm;
        let validTypes = false;
        //Check campi
        function checkFormRestaurantName() {
            //restaurant
            const nameR = document.getElementById('restaurant_name').value;
            const nameTooltipR = document.getElementById('nameRestaurantTooltip');
            //controllo campo nome
            if (nameR.length >= 0 && nameR.length < 2) {
                nameTooltipR.classList.add('visible');
                validNameR = false;
                buttonActivate()
                return validNameR;
            } else {
                nameTooltipR.classList.remove('visible');
                validNameR = true;
                buttonActivate();
                return validNameR;
            }

        }

        function checkFormRestaurantAddress() {

            const address = document.getElementById('address').value;
            const addressTooltip = document.getElementById('addressTooltip');
            //Controllo indirizzo
            if (address.length >= 0 && address.length < 5) {
                addressTooltip.classList.add('visible');
                validAddress = false;
                buttonActivate()
                return validAddress;
            } else {
                validAddress = true;
                addressTooltip.classList.remove('visible');
                buttonActivate();
                return validAddress;
            }
        }

        function checkFormRestaurantPiva() {

            const piva = document.getElementById('piva').value;
            const pivaTooltip = document.getElementById('pivaTooltip');
            //Controllo Piva
            if (piva.length >= 0 && piva.length != 11) {
                pivaTooltip.classList.add('visible');
                validPiva = false;
                buttonActivate();
                return validPiva;
            } else {
                validPiva = true;
                pivaTooltip.classList.remove('visible');
                buttonActivate();
                return validPiva;
            }
        }


        function checkFormRestaurantImg() {
            // se valore non esiste alert
            const img = document.getElementById('img').value;
            const imgTooltip = document.getElementById('imgTooltip');
            //Controllo Piva
            if (img.length > 0) {
                // console.log('aggiunto un file');
                validImg = true;
                imgTooltip.classList.remove('visible');
                buttonActivate();
                return validImg;
            } else {
                // console.log('Non ci sono file');
                imgTooltip.classList.add('visible');
                validImg = false;
                buttonActivate();
                return validImg;
            }
        }

        function checkFormUserName() {
            const name = document.getElementById('name').value;
            const nameTooltip = document.getElementById('nameTooltip');
            //controllo campo nome
            if (name.length >= 0 && name.length < 2) {
                nameTooltip.classList.add('visible');
                validName = false;
                buttonActivate();
                return validName;
            } else {
                validName = true;
                nameTooltip.classList.remove('visible');
                buttonActivate();
                return validName;
            }
        }

        function checkFormUserEmail() {
            const email = document.getElementById('email').value;
            const emailTooltip = document.getElementById('emailTooltip');
            //Controllo indirizzo
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                emailTooltip.classList.add('visible');
                validEmail = false;
                buttonActivate();
                return validEmail;
            } else {
                validEmail = true;
                emailTooltip.classList.remove('visible');
                buttonActivate();
                return validEmail;
            }
        }

        function checkFormUserPassword() {

            const password = document.getElementById('password').value;
            const passwordTooltip = document.getElementById('passwordTooltip');
            // Controllo Password
            if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(password)) {
                passwordTooltip.classList.add('visible');
                validPswd = false;
                buttonActivate();
                return validPswd;
            } else {
                passwordTooltip.classList.remove('visible');
                validPswd = true;
                buttonActivate();
                return validPswd;
            }

        }

        function checkFormUserPasswordConfirm() {
            const password = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('password-confirm').value;
            const passwordConfirmTooltip = document.getElementById('password-confirmTooltip');
            // Controllo Password di conferma
            if (passwordConfirm !== password) {
                passwordConfirmTooltip.classList.add('visible');
                validPswdConfirm = false;
                buttonActivate();
                return validPswdConfirm;
            } else {
                validPswdConfirm = true;
                passwordConfirmTooltip.classList.remove('visible');
                buttonActivate();
                return validPswdConfirm;
            }

        }

        function buttonActivate() {
            if (validNameR &&
                validAddress && validPiva && validName && validEmail && validPswdConfirm && validTypes && validImg
            ) {
                document.getElementById('submitBtn').disabled = false;
            } else {
                document.getElementById('submitBtn').disabled = true;
            }
        }

        /* TYPES VALIDATION */
        const typeCheckboxes = document.querySelectorAll('input[name="types[]"]');
        typeCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('click', checkFormRestaurantTypes);
        });

        // Function to validate the types checkboxes
        function checkFormRestaurantTypes() {
            validTypes = false;
            const typesError = document.getElementById('typesError');

            // Check if at least one checkbox is checked
            typeCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    validTypes = true;
                    // typesError.style.display = 'none';

                    return validTypes;
                }
            });

            // Show or hide error message based on the validation
            if (!validTypes) {
                typesError.style.display = 'inline';
            } else {
                typesError.style.display = 'none';
            }

            buttonActivate();
        }


        // funzione che cambia l'anteprima del file caricato
        /* function showImg(event) {
            const thumb = document.getElementById('thumb');
            thumb.src = URL.createObjectURL(event.target.files[0]);
        } */
    </script>
@endsection
