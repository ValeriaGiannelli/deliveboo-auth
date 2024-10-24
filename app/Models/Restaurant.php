<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Type;
use App\Models\Product;
use App\Models\Lead;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_name',
        'slug',
        'address',
        'piva',
        'img',
        'description'
    ];

    // relazione one to one con user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relazione many to many con type
    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    // relazione one to many con product: restourant one - product many
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // relazione ont to many con leads
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
