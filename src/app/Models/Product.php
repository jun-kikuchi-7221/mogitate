<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'image', 'description'];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }
    // use HasFactory;
}
