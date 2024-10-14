<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'piva', 'img', 'description'
    ];

    // relazione con user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
