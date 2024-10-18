{{-- questa view estende il file main.blade.php che è dentro la cartella view/layouts --}}
@extends('layouts.app')



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 my-4">
                @auth
                    @include('admin.partials.aside')
                @endauth
            </div>
            <div class="col-10 my-4">
                <h2>Crea un nuovo piatto</h2>

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

                <form class="row g-3" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Name --}}
                    <div class="col-md-6 position-relative">
                        <label for="name" class="form-label">Nome del piatto (*)</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Scrivi il nome del piatto" value="{{ old('name') }}" required>
                        {{-- Errori client --}}
                        <div class="tooltip-error" id="nameTooltip">Il nome è obbligatorio e deve avere due caratteri</div>
                        {{-- se esiste l'errore title stampa un messaggio anche sotto l'input --}}
                        @error('name')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror

                    </div>
                    {{-- Ingredienti --}}
                    <div class="col-md-12 position-relative">
                        <label for="ingredients_descriptions" class="form-label">Ingredienti / Descrizione (*)</label>
                        <input type="text" class="form-control @error('ingredients_descriptions') is-invalid @enderror"
                            id="ingredients_descriptions" name="ingredients_descriptions"
                            placeholder="Inserisci gli ingredienti e la descrizione del piatto"
                            value="{{ old('ingredients_descriptions') }}" required>
                        {{-- Errori client --}}
                        <div class="tooltip-error" id="ingredientsTooltip">Campo obbligatorio</div>
                        @error('ingredients_descriptions')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- caricamento img --}}
                    <div class="col-12">
                        <label for="img" class="form-label">Immagine prodotto (*)</label>
                        <input type="file" name="img" id="img" class="form-control" onchange="showImg(event)"
                        accept="image/*" required>


                        {{-- Errori front-end --}}

                        <div class="col-md-6 position-relative">
                            <div class="tooltip-error" id="imgTooltip">L'immagine è obbligatoria.</div>
                        </div>

                        {{-- anteprima dell'immagine caricata --}}
                        <img src="{{ asset('storage/uploads/no_img.jpg') }}" class="thumb-mini" id="thumb">

                        @error('img')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- inserimento prezzo --}}
                    <div class="col-md-3 position-relative">
                        <label for="price" class="form-label">Prezzo unitario (*)</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" placeholder="Inserisci il prezzo" value="{{ old('price') }}" step="0.01"
                            required>
                        {{-- Errori client --}}
                        <div class="tooltip-error" id="priceTooltip">Il prezzo è obbligatorio e deve essere un numero</div>
                        @error('price')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- radio button per la visibilità --}}
                    <div class="col-12">
                        <label for="img" class="form-label">Prodotto visibile al pubblico: (*)</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="visible" name="visible" class="custom-control-input" value=1>
                            <label class="custom-control-label" for="visible">Sì</label>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="not_visible" name="visible" class="custom-control-input" value=0>
                            <label class="custom-control-label" for="not_visible">No</label>
                        </div>

                        <small id="visibleError" class="text-danger" style="display: none;">Devi selezionare una delle
                            opzioni.</small>

                        @error('visible')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>


                    {{-- bottoni --}}
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Invia</button>
                    </div>
                    <div class="col-12">
                        <button type="reset" class="btn btn-primary" onclick="checkForm()">Cancella</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
    {{-- funzioni --}}
    <script>
        //Listener per i campi
        document.getElementById('name').addEventListener('input', checkFormProductName);
        document.getElementById('ingredients_descriptions').addEventListener('input', checkFormProductIngredients);
        document.getElementById('price').addEventListener('input', checkFormProductPrice);
        document.getElementById('visible').addEventListener('click', checkboxValidate);
        document.getElementById('not_visible').addEventListener('click', checkboxValidate);
        document.getElementById('img').addEventListener('click', checkFormRestaurantImg);
        document.getElementById('img').addEventListener('input', checkFormRestaurantImg);

        let validName;
        let validIngredients;
        let validImg;
        let validPrice;
        let validCheck;

        function checkFormProductName() {
            //restaurant
            const name = document.getElementById('name').value;
            const nameTooltip = document.getElementById('nameTooltip');
            //controllo campo nome
            if (name.length >= 0 && name.length < 2) {
                nameTooltip.classList.add('visible');
                validName = false;
                buttonActivate();
                return validName;
            } else {
                nameTooltip.classList.remove('visible');
                validName = true;
                buttonActivate();
                return validName;
            }
        }

        function checkFormProductIngredients() {
            const ingredients_descriptions = document.getElementById('ingredients_descriptions').value;
            const ingredientsTooltip = document.getElementById('ingredientsTooltip');
            //Controllo ingredienti
            if (ingredients_descriptions.length >= 0 && ingredients_descriptions.length < 2) {
                ingredientsTooltip.classList.add('visible');
                validIngredients = false;
                buttonActivate();
                return validIngredients;
            } else {
                ingredientsTooltip.classList.remove('visible');
                validIngredients = true;
                buttonActivate();
                return validIngredients;
            }
        }

        function checkFormRestaurantImg() {
            // se valore non esiste alert
            const img = document.getElementById('img').value;
            const imgTooltip = document.getElementById('imgTooltip');
            //Controllo Piva
            if (img.length > 0 ) {
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

        function checkFormProductPrice() {
            const price = document.getElementById('price').value;
            const priceTooltip = document.getElementById('priceTooltip');
            //Controllo price
            if (!isNaN(price) && price > 0) {
                priceTooltip.classList.remove('visible');
                validPrice = true;
                buttonActivate();
                return validPrice;

            } else {
                validPrice = false;
                priceTooltip.classList.add('visible');
                buttonActivate();
                return validPrice;
            }
        }

        function buttonActivate() {
            if (validName && validPrice && validIngredients && validCheck && validImg) {
                document.getElementById('submitBtn').disabled = false;
            } else if ((validName || validPrice || validIngredients || validCheck)) {
                document.getElementById('submitBtn').disabled = true;
            }
        }

        function checkboxValidate() {
            //const visibleChecked = document.querySelector('input[name="visible"]');
            const visible = document.getElementById('visible');
            const notvisible = document.getElementById('not_visible');
            const visibleError = document.getElementById('visibleError');

            if (!visible.checked && !notvisible.checked) {
                visibleError.style.display = 'block';
                validCheck = false;
                buttonActivate();
                return validCheck;
            } else if (visible.checked || notvisible.checked) {
                visibleError.style.display = 'none';
                validCheck = true;
                buttonActivate();
                return validCheck;
            }
        }




        // funzione che cambia l'anteprima del file caricato
        function showImg(event) {
            const thumb = document.getElementById('thumb');
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

@endsection
