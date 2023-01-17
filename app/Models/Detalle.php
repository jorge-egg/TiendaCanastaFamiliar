<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;

    protected $table = 'detallePedido';

    protected $primaryKey = 'idDetalle';

    protected $fillable = [
        'idPedido', 'idProducto', 'cantidad', 'precioTotal'
    ];

    public $timestamps = false;

    public function pedidos(){
        return $this->belongsTo(pedidos::class);
    }
    public function producto(){
        return $this->belongsTo(producto::class);
    }
}
