<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;
use App\Models\MstIngredient;
use App\Models\MstProcess;
use App\Models\Process;

class Recipe extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function ingredient():object
    {
        return $this->hasMany(Ingredient::class);
    }


    public function process():object
    {
        return $this->hasMany(Process::class);
    }


    public function mstIngredient():object
    {
        return $this->hasMany(MstIngredient::class,'type','type');
    }

    
    public function mstProcess():object
    {
        return $this->hasMany(MstProcess::class,'type','type');
    }

}
