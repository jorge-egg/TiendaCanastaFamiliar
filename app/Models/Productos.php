<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table='Productos';

    protected $primaryKey='idProducto';

    protected $fillable=['nombre', 'img', 'precio', 'disponibilidad', 'referencia'];

    public function Carro(){
        return $this->belongsTo(Carro::class);
    }
    public function detalle(){
        return $this->hasMany(detalle::class);
    }
    public $timestamps = false;
}
