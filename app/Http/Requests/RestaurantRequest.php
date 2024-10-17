<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'restaurant_name' => 'required|min:2|max:100',
            'address' => 'required|min:5|max:100',
            'piva' => 'required|min:11|max:11',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'restaurant_name.required' => 'Il nome è obbligatorio',
            'restaurant_name.min' => 'Il nome deve avere minimo :min caratteri',
            'restaurant_name.max' => 'Il nome deve avere massimo :max caratteri',
            'address.required' => 'L\'indirizzo è obbligatorio',
            'address.min' => 'L\'indirizzo deve avere minimo :min caratteri',
            'address.max' => 'L\'indirizzo deve avere massimo :max caratteri',
            'piva.required' => 'La partita iva è obbligatoria',
            'piva.min' => 'La partita iva deve avere minimo :min caratteri',
            'piva.max' => 'La partita iva deve avere massimo :max caratteri',
            'img.required' => 'Devi caricare un\'immagine del ristorante.',
            'img.image' => 'Il file deve essere un\'immagine.',
            'img.mimes' => 'Le immagini devono essere di tipo jpeg, png, jpg o gif.',
            'img.max' => 'L\'immagine non deve superare i 2 MB.',
            'description.max' => 'La descrizione deve avere massimo :max caratteri',
        ];
    }
}
