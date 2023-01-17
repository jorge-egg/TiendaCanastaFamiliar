<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table='Usuarios';

    protected $primaryKey='idUsuario';

    protected $fillable=['nombre', 'telefono', 'direccion', 'correo', 'fotoPerfil'];

    public function carro(){
        return $this->belongsTo(carro::class);
    }
    public $timestamps = false;
}
