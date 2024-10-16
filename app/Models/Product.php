<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\Sale;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'ingredients_descriptions', 'img', 'price', 'visible', 'restaurant_id'
    ];

    // relazione one to many con restaurant
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    // relazione many to many con sale
    public function sales(){
        return $this->belongsToMany(Sale::class, 'product_sale')
                    ->withPivot('amount', 'price');
    }
}
