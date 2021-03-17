<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $fillable=[
        'articulo',
        'referencia',
        'localizacion',
        'tipo_unidad',
        'minimo',
        'maximo',
        'id_proveedor',
    ];

    public function detalle()
    {
        return $this->hasOne(DetalleProducto::class,'id_producto')->orderBy('created_at', 'desc');
    }
}
