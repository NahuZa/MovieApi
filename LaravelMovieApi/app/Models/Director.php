<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name'
    ];

    public function movies(){
        return $this->hasMany(Movie::class);
    }
}
