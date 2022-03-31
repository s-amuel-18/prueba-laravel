<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id"
    ];

    public function compras()
    {
        // return DB::table("users")->get();
        // return $consulta;
        return $this->belongsToMany(Compra::class, "compra_factura");
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
