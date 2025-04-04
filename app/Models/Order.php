<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maker;

class Order extends Model
{
    protected $guarded = ['id'];
    
    public function maker():object
    {
        return $this->belongsTo(Maker::class);
    }
}
