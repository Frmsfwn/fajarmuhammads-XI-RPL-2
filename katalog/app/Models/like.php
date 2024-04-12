<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'like',
    ];
    protected $table = 'like';

    public function product(){
        return $this->belongsTo(product::class, 'product_id');
    }

}
