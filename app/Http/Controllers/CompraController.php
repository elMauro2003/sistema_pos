<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompraRequest;
use App\Models\Compra;
use App\Models\Comprobante;
use App\Models\Producto;
use App\Models\Proveedore;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('comprobante', 'proveedore.persona')->where('estado', 1)->latest()->get();

        return view('compra.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedore::whereHas('persona', function ($query) {
            $query->where('estado', 1);
        })->get();
        $comprobantes = Comprobante::all();
        $productos = Producto::where('estado', 1)->get();
        return view('compra.create', compact('proveedores', 'comprobantes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request)
    {
        try {
            DB::beginTransaction();

            // Llenar la tabla
            $compra = Compra::create($request->validated());

            // Llenar la tabla compra_producto
            //1.Recuperar la compra
            $arrayProducto_id = $request->get('arrayidproducto');
            $arrayCantidad = $request->get('arraycantidad');
            $arrayPrecioCompra = $request->get('arraypreciocompra');
            $arrayPrecioVenta = $request->get('arrayprecioventa');

            //2.Realizar el llenado
            $sizeArray = count($arrayProducto_id);
            $cont = 0;

            while ($cont < $sizeArray) {
                $compra->productos()->syncWithoutDetaching([
                    // syncWithoutDetaching -> esto es para el llenado de las tablas pivote
                    $arrayProducto_id[$cont] => [
                        'cantidad' => $arrayCantidad[$cont],
                        'precio_compra' => $arrayPrecioCompra[$cont],
                        'precio_venta' => $arrayPrecioVenta[$cont],
                    ],
                ]);

                //3.Actualizar el stock
                $producto = Producto::find($arrayProducto_id[$cont]);
                $stockActual = $producto->stock;
                $stockNuevo = intval($arrayCantidad[$cont]);

                DB::table('productos')
                    ->where('id', $producto->id)
                    ->update([
                        'stock' => $stockActual + $stockNuevo,
                    ]);
                $cont++;
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('compras.index')->with('success', 'Compra realizada con exito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        return view('compra.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Compra::where('id', $id)->update([
            'estado' => 0,
        ]);
        return redirect()->route('compras.index')
        ->with('success', 'Compra eliminada correctamente!');
    }
}
