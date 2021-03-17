<?php

namespace App\Http\Controllers;

use App\DetalleProducto;
use App\Http\Requests\DetalleProductoDevolucionRequest;
use App\Http\Requests\DetalleProductoRequest;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class DetalleProductoController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id_producto) {
            $detalleProductos = DetalleProducto::where('id_producto', $request->id_producto)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $detalleProductos = DetalleProducto::orderBy('created_at', 'desc')
                ->get();
        }
        return $this->successResponse($detalleProductos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function returnCompra(DetalleProductoDevolucionRequest $request)
    {
        $devolucion = DetalleProducto::where('id', $request->id)->first();
        if($devolucion->devuelto == true){
            return $this->errorResponse("El movimiento ya fue revertido anteriormente", 404);
        }
        $saldoActual = DetalleProducto::where('id_producto', $devolucion->id_producto)
            ->orderBy('created_at', 'desc')
            ->first();
        if($saldoActual->saldo_cantidad < $devolucion['entrada_cantidad']){
            return $this->errorResponse("No hay suficientes unidades para la devolucion", 404);
        }
        $saldoCantidad = $saldoActual['saldo_cantidad'] - $devolucion['entrada_cantidad'];
        $saldoValor =  $saldoActual['saldo_valor'] - $devolucion['entrada_valor'];
        $costoPromedioPonderado = $saldoCantidad == 0 ? 0 : $saldoValor / $saldoCantidad;
        $detalleProducto = DetalleProducto::create([
            "descripcion" => $request->descripcion,
            "valor_unitario" => $costoPromedioPonderado,
            "entrada_cantidad" => $devolucion['entrada_cantidad'] * -1,
            "entrada_valor" => $devolucion['entrada_valor'] * -1,
            "saldo_cantidad" => $saldoCantidad,
            "saldo_valor" => $saldoValor,
            "id_producto" => $devolucion->id_producto,
            "devuelto" => true,
        ]);
        $devolucion->update(["devuelto" => true]);
        return $this->successResponse($detalleProducto, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCompra(DetalleProductoRequest $request)
    {
        $request['entrada_valor'] = $request->cantidad * $request->valor_unitario;
        $saldoActual = DetalleProducto::where('id_producto', $request->id_producto)
            ->orderBy('created_at', 'desc')
            ->first();
        $saldoCantidad = $saldoActual['saldo_cantidad'] + $request->cantidad;
        $saldoValor =  $saldoActual['saldo_valor'] + $request['entrada_valor'];
        $costoPromedioPonderado =  $saldoValor / $saldoCantidad;
        $detalleProducto = DetalleProducto::create([
            "descripcion" => $request->descripcion,
            "valor_unitario" => $costoPromedioPonderado,
            "entrada_cantidad" => $request->cantidad,
            "entrada_valor" => $request['entrada_valor'],
            "saldo_cantidad" => $saldoCantidad,
            "saldo_valor" => $saldoValor,
            "id_producto" => $request->id_producto,
        ]);
        return $this->successResponse($detalleProducto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetalleProducto  $detalleProducto
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleProducto $detalleProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetalleProducto  $detalleProducto
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleProducto $detalleProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetalleProducto  $detalleProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleProducto $detalleProducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetalleProducto  $detalleProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleProducto $detalleProducto)
    {
        //
    }
}
