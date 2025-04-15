<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cocktail extends Model
{
    //

    use HasFactory;

    protected $fillable = [
        'idDrink',
        'strDrink',
        'strCategory',
        'strGlass',
        'strInstructions',
        'strDrinkThumb',
    ];
}
