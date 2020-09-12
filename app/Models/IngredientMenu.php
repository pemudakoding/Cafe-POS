<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientMenu extends Model
{
    protected $guarded = [];

    public function ingredients()
    {
        return $this->hasOne('App\Models\Ingredients', 'id', 'id_ingredient');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu', 'id_menu', 'id');
    }
}
