<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        return $this->successResponse($productos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = Producto::create([
            "nombre" => $request->nombre,
            "valor" => $request->valor,
        ]);
        return $this->successResponse($producto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return $this->successResponse($producto, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->update([
            "nombre" => $request->nombre,
            "valor" => $request->valor
        ]);
        return $this->successResponse($producto, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return $this->successResponse('Producto Eliminado Exitosamente', 200);
    }
}
