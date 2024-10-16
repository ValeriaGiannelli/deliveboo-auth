{{-- questa view estende il file main.blade.php che è dentro la cartella view/layouts --}}
@extends('layouts.app')



@section('content')
<div class="container-fluid d-flex">
        @auth
            @include('admin.partials.aside')
        @endauth
    <div class="container my-5">

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

        <form class="row g-3" action="{{route('admin.products.update', $product)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-6 position-relative">
                <label for="name" class="form-label">Nome del piatto (*)</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Scrivi il nome del piatto" value="{{old('name', $product->name)}}">

                {{-- Errori client --}}
                <div class="tooltip-error" id="nameTooltip">Il nome è obbligatorio e deve avere due caratteri</div>

                {{-- errori back-end --}}
                @error('name')
                    <small class="text-danger"> {{$message}} </small>
                @enderror

            </div>

            <div class="col-md-12 position-relative">
                <label for="ingredients_descriptions" class="form-label">Ingredienti / Descrizione (*)</label>
                <input type="text" class="form-control @error('ingredients_descriptions') is-invalid @enderror" id="ingredients_descriptions" name="ingredients_descriptions" placeholder="Inserisci gli ingredienti e la descrizione del piatto" value="{{old('ingredients_descriptions', $product->ingredients_descriptions)}}">

                {{-- Errori client --}}
                <div class="tooltip-error" id="ingredientsTooltip">Campo obbligatorio</div>

                {{-- errori back-end --}}
                @error('ingredients_descriptions')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>

            {{-- caricamento img --}}
            <div class="col-12 position-relative">
                <label for="img" class="form-label">Immagine prodotto (*)</label>
                <input type="file" name="img" id="img" class="form-control" onchange="showImg(event)">

                {{-- Errori client --}}
                {{-- <div class="tooltip-error" id="imgTooltip">L'immagine è obbligatoria e deve rispettare il formato</div> --}}

                {{-- errori back-end --}}
                @error('img')
                    <small class="text-danger"> {{$message}} </small>
                @enderror

                <img src="{{asset('storage/' . $product->img)}}" alt="{{ $product->name }}" onerror="this.src='{{asset('storage/uploads/no_img.jpg')}}'" class="thumb-mini" id="thumb">
            </div>

            {{-- inserimento prezzo --}}
            <div class="col-md-3 position-relative">
                <label for="price" class="form-label">Prezzo unitario (*)</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Inserisci gli ingredienti e la descrizione del piatto" value="{{old('price', $product->price)}}" step="0.01">

                {{-- Errori client --}}
                <div class="tooltip-error" id="priceTooltip">Il prezzo è obbligatorio e deve essere un numero</div>

                {{-- errori back-end --}}
                @error('price')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
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

                <small id="visibleError" class="text-danger" style="display: none;">Devi selezionare una delle
                    opzioni.</small>

                @error('visible')
                    <small class="text-danger"> {{$message}} </small>
                @enderror
            </div>


            {{-- bottoni --}}
            <div class="col-12">
                <button type="submit" class="btn btn-primary" id="submitBtn">Invia</button>
            </div>
            <div class="col-12">
                <button type="reset" class="btn btn-primary" onclick="checkForm()">Cancella</button>
            </div>
        </form>
    </div>
</div>

  {{-- funzioni --}}
  <script>
    //Listener per i campi
    document.getElementById('name').addEventListener('input', checkForm);
    document.getElementById('ingredients_descriptions').addEventListener('input', checkForm);
    document.getElementById('price').addEventListener('input', checkForm);

    // document.getElementById('img').addEventListener('click', checkForm);


    //Check campi
    function checkForm() {
        let validName = false;
        let validIngredients = false;
        let validPrice = false;
        // let validimg = false;
        const name = document.getElementById('name').value;
        const ingredients_descriptions = document.getElementById('ingredients_descriptions').value;
        const price = document.getElementById('price').value;
        // const img = document.getElementById('img').files[0];
        const nameTooltip = document.getElementById('nameTooltip');
        const ingredientsTooltip = document.getElementById('ingredientsTooltip');
        const priceTooltip = document.getElementById('priceTooltip');
        // const imgTooltip = document.getElementById('imgTooltip');



        //controllo campo nome
        if (name.length >= 0 && name.length < 2) {
            nameTooltip.classList.add('visible');
            validName = false;
        } else {
            validName = true;
            nameTooltip.classList.remove('visible');
        }
        //Controllo ingredienti
        if (ingredients_descriptions.length >= 0 && ingredients_descriptions.length < 2) {
            ingredientsTooltip.classList.add('visible');
            validIngredients = false;
        } else {
            validIngredients = true;
            ingredientsTooltip.classList.remove('visible');

        }
        //Controllo price
        if (!isNaN(price) && price > 0) {
            priceTooltip.classList.remove('visible');
            validPrice = true;
            console.log(validPrice);

        } else {
            validPrice = false;
            priceTooltip.classList.add('visible');
            console.log(validPrice);
        }
        // //Controllo img
        // if (img) {
        //     const fileType = file.type; // Ottieni il tipo di file
        //     const fileSize = file.size; // Ottieni la dimensione del file in byte
        // // Controlla i formati e la dimensione
        //     if (
        //         (fileType === 'image/jpeg' || fileType === 'image/png' || fileType === 'image/jpg' || fileType === 'image/gif') &&
        //         fileSize <= 2048 * 1024 // Converti KB in byte
        //     ) {
        //         imgTooltip.classList.remove('visible'); // Nascondi il tooltip
        //         validImage = true;
        //     } else {
        //         imgTooltip.classList.add('visible'); // Mostra il tooltip
        //         imgTooltip.innerHTML = "Formato immagine non valido o dimensione superiore a 2 MB. Formati consentiti: JPEG, PNG, JPG, GIF.";
        //         validImage = false;
        //     }
        // } else {
        //     imgTooltip.classList.add('visible'); // Mostra il tooltip se non è stato selezionato alcun file
        //     imgTooltip.innerHTML = "È necessario caricare un'immagine.";
        //     validImage = false;
        // }


        //Bottoni
        if (validName && validIngredients && validPrice) {
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
