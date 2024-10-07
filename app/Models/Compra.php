<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    public function proveedore(){
        return $this->belongsTo(Proveedore::class);
    }

    public function comprobante(){
        return $this->belongsTo(Comprobante::class);
    }
    
    public function productos(){
        return $this->belongsToMany(Producto::class)
        ->withTimestamps()
        ->withPivot('cantidad', 'precio_compra', 'precio_venta');
    }

}
