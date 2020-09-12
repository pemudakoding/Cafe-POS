<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];
    public function ingredients()
    {
        return $this->belongsToMany('App\Models\Ingredients', 'ingredient_menus', 'id_menu', 'id_ingredient');
    }
    public function ingredient_menus()
    {
        return $this->hasMany('App\Models\IngredientMenu', 'id_menu', 'id');
    }
    public function getPhotoAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
