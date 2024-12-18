<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:70',
            'ingredients_descriptions' => 'required|min:1',
            'img' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
                Rule::requiredIf(function (){
                    // se non c'è un'immagine esistente, rendi il campo obbligatorio
                    return $this->isMethod('post');
                }),
            ],
            'price' => 'required|numeric',
            'visible' => 'required|boolean'

        ];
    }

    // metodo per i messaggi di errore
    public function messages(): array
    {
        return [
            'name.required' => 'Nome del piatto richiesto',
            'name.min' => 'Sono richiesti :min caratteri',
            'name.man' => 'Hai superato il numero di :max caratteri',
            'ingredients_descriptions.required' => 'Descrizione del piatto richiesta',
            'ingredients_descriptions.min' => 'Sono richiesti :min caratteri',
            'img.required' => 'Immagine obbligatoria',
            'img.min' => 'Immagine troppo corta',
            'price.required' => 'Prezzo obbligatorio',
            'price.numeric' => 'Il prezzo deve essere inserito con delle cifre',
            'visible.required' => 'Selezionare un opzione',
            'visible.boolean' => 'La risposta può essere Si o No'

        ];
    }
}
