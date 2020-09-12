<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $guarded = [];

    public function menus()
    {
        return $this->hasOne('App\Models\Menu', 'id', 'id_menu');
    }

    public function ingredientMenu()
    {
        return $this->hasMany('App\Models\IngredientMenu', 'id_menu', 'id_menu');
    }
}
