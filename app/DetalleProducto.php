<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleProducto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'descripcion',
        'valor_unitario',
        'entrada_cantidad',
        'entrada_valor',
        'salida_cantidad',
        'salida_valor',
        'saldo_cantidad',
        'saldo_valor',
        'id_producto',
        'devuelto',
    ];
}
