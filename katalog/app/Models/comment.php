<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'comment',
    ];
    protected $table = 'comment';

    public function user(){
        return $this->belongsTo(user::class, 'user_id');
    }
    public function product(){
        return $this->belongsTo(product::class, 'product_id');
    }
}
