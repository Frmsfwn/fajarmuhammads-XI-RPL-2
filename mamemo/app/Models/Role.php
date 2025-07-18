<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'role';

    protected $fillable = [
        'id',
        'name',
    ];

    public static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
