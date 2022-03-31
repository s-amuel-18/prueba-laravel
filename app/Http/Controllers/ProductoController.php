<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Illuminate\Routing\Route;

class ProductoController extends Controller
{

    /**
     * Class constructor.
     */
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
        // dd(Auth::user());
        $productos = Producto::orderBy("created_at", "DESC")->paginate(10);
        $data["productos"] = $productos;

        return view("producto.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        if( auth()->user()->rol != "admin" ) {
            return redirect()->route("producto.index");
        }

        // autenticado
        return view("producto.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( auth()->user()->rol != "admin" ) {
            return redirect()->route("producto.index");
        }

        // validacion
        $data = request()->validate([
            "nombre" => "required|string",
            "precio_con_impuesto" => "required|numeric|min:1",
            "procentaje_impuesto" => "required|numeric|min:1|max:99"
        ]);

        // inserta en base de datos
        Producto::create([
            "nombre" => $data["nombre"],
            "precio_con_impuesto" => $data["precio_con_impuesto"],
            "procentaje_impuesto" => $data["procentaje_impuesto"]
        ]);

        // redirecciona
        return redirect()->route("producto.index")->with("message", "El producto " . $data["nombre"] . " Se ha creado correctamente");
    }

    public function compra(Producto $producto)
    {

        // crea datos
        $create_data = [
            "user_id" => auth()->user()->id,
            "producto_id" => $producto->id
        ];

        // inserta
        Compra::create($create_data);

        // redirecciona
        return back()->with("message", "El producto se ha agregado a la compra Exitosamente");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        if( auth()->user()->rol != "admin" ) {
            return redirect()->route("producto.index");
        }

        $data["producto"] = $producto;
        return view("producto.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        if( auth()->user()->rol != "admin" ) {
            return redirect()->route("producto.index");
        }
        // dd($request);
        $data = request()->validate([
            "nombre" => "required|string",
            "precio_con_impuesto" => "required|numeric|min:1",
            "procentaje_impuesto" => "required|numeric|min:1|max:99"
        ]);

        $producto->nombre = $data["nombre"];
        $producto->precio_con_impuesto = $data["precio_con_impuesto"];
        $producto->procentaje_impuesto = $data["procentaje_impuesto"];

        $producto->save();

        return back()->with("message", "Se ha actualizadp");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        if( auth()->user()->rol != "admin" ) {
            return redirect()->route("producto.index");
        }

        $producto->delete();
        // dd($producto);

        return back()->with("message", "Se ha eliminado correctamente");
    }
}
