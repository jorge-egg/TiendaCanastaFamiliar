<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $table = 'carro';

    protected $primaryKey = 'idCarro';

    protected $fillable = [
        'precio', 'cantidad', 'total', 'idProducto', 'idUsuario'
    ];

    public $timestamps = false;

    public function productos(){
        return $this->hasMany(producto::class);
    }
    public function usuarios(){
        return $this->hasMany(usuario::class);
    }
    public function pedidos(){
        return $this->belongsTo(pedido::class);
    }
}
