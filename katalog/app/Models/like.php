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
    ];
    protected $table = 'like';

    public function product(){
        return $this->belongsTo(product::class, 'product_id');
    }

    public function user(){
        return $this->belongsTo(user::class, 'user_id');
    }

}
