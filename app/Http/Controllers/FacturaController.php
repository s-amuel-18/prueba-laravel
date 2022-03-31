<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Compra;
use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( auth()->user()->rol != "admin" ) {
            return redirect()->route("producto.index");
        }

        $data["compras_sin_facturar"] = Compra::where("facturado", "=", "0")->count();
        // dd($data["compras_sin_facturar"]);
        $facturas = Factura::orderBy("created_at", "DESC")->paginate(10);
        $data["facturas"] = $facturas;

        return view("factura.index", $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        if( auth()->user()->rol != "admin" ) {
            return redirect()->route("producto.index");
        }

        $productos = Compra::select(
            DB::raw('sum(productos.precio_con_impuesto) as precio_con_impuesto'),
            DB::raw("count(productos.id) as count_productos"),
            DB::raw("productos.nombre as nombre"),
            DB::raw("sum(productos.precio_con_impuesto * ((100 - productos.procentaje_impuesto) * 0.01)) as precio_sin_impuesto"),
            DB::raw("sum(productos.procentaje_impuesto) as procentaje_impuesto"),
        )
            ->join('productos', 'compras.producto_id', '=', 'productos.id')
            ->join('compra_factura', 'compra_factura.compra_id', '=', 'compras.id')
            ->where("compra_factura.factura_id", "=", $factura->id)
            ->groupBy('compras.producto_id')
            ->orderBy("count_productos")
            ->get();

        // dd($productos);
        $data["productos"] = $productos;

        $data["factura"] = $factura;
        // dd($factura->);


        return view("factura.show", $data);
    }

    public function facturar()
    {
        if( auth()->user()->rol != "admin" ) {
            return redirect()->route("producto.index");
        }

        $clientes_id = Compra::select("user_id")->where("facturado", "=", "0")->groupBy("user_id")->get();

        if(count($clientes_id) == 0 ) {
            return redirect()->route("factura.index")->with("message", "no hay ninguna compras para facturar");
        }

        foreach ($clientes_id as  $cli_od) {

            $cliente_id = $cli_od->user_id;

            Factura::create([
                "user_id" => $cliente_id
            ]);

            $ultima_factura = Factura::select("id")->latest()->get()[0]->id;

            $compras = Compra::where(["user_id" => $cliente_id, "facturado" => 0])->get();

            foreach ($compras as $compra) {
                DB::table("compra_factura")->insert([
                    "factura_id" => $ultima_factura,
                    "compra_id" => $compra->id
                ]);

                $compra->facturado = 1;
                $compra->save();
            }


        }
        return redirect()->route("factura.index")->with("message", "facturas creadas correctamente");
    }
}
