<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'message'];

    // relazione one to many con restaurant
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
