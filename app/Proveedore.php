<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedore extends Model
{
    use SoftDeletes;

    protected $table ='proveedors';
    protected $fillable=[
        'nombre'
    ];
}
