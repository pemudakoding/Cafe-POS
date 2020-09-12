<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    protected $guarded = [];

    public function ingredient_menus()
    {
        return $this->hasMany('App\Models\IngredientMenu', 'id_menu', 'id');
    }
}
