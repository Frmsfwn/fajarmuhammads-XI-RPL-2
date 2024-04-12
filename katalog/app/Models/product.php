<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'product_name',
        'product_image',
        'product_link',
        'product_price',
    ];
    protected $table = 'product';

    public function comment() : HasMany
    {
        return $this->hasMany(comment::class);
    }

    public function like() : HasMany
    {
        return $this->hasMany(like::class);
    }

}
