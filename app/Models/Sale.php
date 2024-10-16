<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'email', 'address', 'total_price', 'phone_number'
    ];


    // relazione many to many con products
    public function products(){
        return $this->belongsToMany(Product::class, 'product_sale')
                    ->withPivot('amount', 'price');
    }
}
