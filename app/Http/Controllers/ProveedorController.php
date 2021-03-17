<?php

namespace App\Http\Controllers;

use App\Proveedore;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    use ApiResponser;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaProveedor = Proveedore::all();
        return $this->successResponse($listaProveedor, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = Proveedore::create(
            [
                'nombre' => $request->nombre
            ]
        );
        return $this->successResponse($proveedor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedore $proveedore)
    {
        return $this->successResponse($proveedore, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Proveedor $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedore $proveedore)
    {
        $proveedore->update([
            'nombre' => $request->nombre
        ]);
        return $this->successResponse($proveedore, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedore $proveedore)
    {
        $proveedore->delete();
        return $this->successResponse('Proveedor Eliminado Exitosamente', 200);
    }
}
