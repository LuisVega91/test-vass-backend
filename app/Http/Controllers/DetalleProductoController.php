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

    public function storeCompra(DetalleProductoRequest $request)
    {
        $saldoActual = DetalleProducto::where('id_producto', $request->id_producto)
            ->orderBy('created_at', 'desc')
            ->first();
        $entradaValor = $request->cantidad * $request->valor_unitario;
        $saldoCantidad = $saldoActual['saldo_cantidad'] + $request->cantidad;
        $saldoValor =  $saldoActual['saldo_valor'] + $entradaValor;
        $costoPromedioPonderado =  $saldoValor / $saldoCantidad;
        $detalleProducto = DetalleProducto::create([
            "descripcion" => $request->descripcion,
            "valor_unitario" => $costoPromedioPonderado,
            "entrada_cantidad" => $request->cantidad,
            "entrada_valor" => $entradaValor,
            "saldo_cantidad" => $saldoCantidad,
            "saldo_valor" => $saldoValor,
            "id_producto" => $request->id_producto,
        ]);
        return $this->successResponse($detalleProducto, 201);
    }


    public function returnCompra(DetalleProductoDevolucionRequest $request)
    {
        $devolucion = DetalleProducto::where('id', $request->id)->first();
        if ($devolucion->entrada_cantidad == null) {
            return $this->errorResponse("El movimiento no es una compra", 404);
        }
        if ($devolucion->devuelto == true) {
            return $this->errorResponse("El movimiento ya fue revertido anteriormente", 404);
        }
        $saldoActual = DetalleProducto::where('id_producto', $devolucion->id_producto)
            ->orderBy('created_at', 'desc')
            ->first();
        if ($saldoActual->saldo_cantidad < $devolucion['entrada_cantidad']) {
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

    public function storeVenta(DetalleProductoRequest $request)
    {
        $saldoActual = DetalleProducto::where('id_producto', $request->id_producto)
            ->orderBy('created_at', 'desc')
            ->first();
        if ($saldoActual['saldo_cantidad'] < $request->cantidad) {
            return $this->errorResponse("No hay suficientes unidades para la venta", 404);
        }
        $salidaValor = $request->cantidad * $saldoActual['valor_unitario'];
        $saldoCantidad = $saldoActual['saldo_cantidad'] - $request->cantidad;
        $saldoValor =  $saldoActual['saldo_valor'] - $salidaValor;
        $costoPromedioPonderado = $saldoCantidad == 0 ? 0 : $saldoValor / $saldoCantidad;
        $detalleProducto = DetalleProducto::create([
            "descripcion" => $request->descripcion,
            "valor_unitario" => $costoPromedioPonderado,
            "salida_cantidad" => $request->cantidad,
            "salida_valor" => $salidaValor,
            "saldo_cantidad" => $saldoCantidad,
            "saldo_valor" => $saldoValor,
            "id_producto" => $request->id_producto,
        ]);
        return $this->successResponse($detalleProducto, 201);
    }

    public function returnVenta(DetalleProductoDevolucionRequest $request)
    {
        $devolucion = DetalleProducto::where('id', $request->id)->first();
        if ($devolucion->salida_cantidad == null) {
            return $this->errorResponse("El movimiento no es una venta", 404);
        }
        if ($devolucion->devuelto == true) {
            return $this->errorResponse("El movimiento ya fue revertido anteriormente", 404);
        }
        $saldoActual = DetalleProducto::where('id_producto', $devolucion->id_producto)
            ->orderBy('created_at', 'desc')
            ->first();
        $saldoCantidad = $saldoActual['saldo_cantidad'] + $devolucion['salida_cantidad'];
        $saldoValor =  $saldoActual['saldo_valor'] + $devolucion['salida_valor'];
        $costoPromedioPonderado = $saldoValor / $saldoCantidad;
        $detalleProducto = DetalleProducto::create([
            "descripcion" => $request->descripcion,
            "valor_unitario" => $costoPromedioPonderado,
            "salida_cantidad" => $devolucion['salida_cantidad'] * -1,
            "salida_valor" => $devolucion['salida_valor'] * -1,
            "saldo_cantidad" => $saldoCantidad,
            "saldo_valor" => $saldoValor,
            "id_producto" => $devolucion->id_producto,
            "devuelto" => true,
        ]);
        $devolucion->update(["devuelto" => true]);
        return $this->successResponse($detalleProducto, 201);
    }
}
