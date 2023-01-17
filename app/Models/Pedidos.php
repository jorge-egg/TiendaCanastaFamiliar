<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $primaryKey = 'idPedido';

    protected $fillable = [
        'idCarro', 'estado', 'idUsuario_cliente', 'idUsuario_despachador'
    ];

    public $timestamps = false;

    public function carro(){
        return $this->hasMany(carro::class);
    }
    public function usuarios(){
        return $this->hasMany(usuario::class);
    }
    public function detalle(){
        return $this->hasMany(detalle::class);
    }
}
