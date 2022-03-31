<?php

namespace App\Models;

use Facade\FlareClient\Http\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "producto_id"
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, "producto_id");
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function factura()
    {
        // return DB::table("users")->get();
        // return $consulta;
        return $this->belongsToMany(Factura::class, "compra_factura");
    }

    // public function (Type $var = null)
    // {
    //     # code...
    // }
}
