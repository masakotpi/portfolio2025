<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MstIngredient;


class Ingredient extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function mstIngredient():object
    {
        return $this->belongsTo(MstIngredient::class);
    }

    public function joinMstIngredients()
    {
        return $this->join('mst_ingredients','mst_ingredients.id','ingredients.mst_ingredient_id');
    }

}
