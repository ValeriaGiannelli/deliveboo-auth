<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'ingredients_descriptions', 'img', 'price', 'visible'
    ];

    // relazione one to many con restaurant
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
