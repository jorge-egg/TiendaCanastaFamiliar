<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class index extends Controller
{
    public function index(){
        $id = Auth::id();
        $productos = Productos::all();
        if($id != null){
            $datos = Usuarios::findOrFail($id);
            ($datos -> fotoPerfil == null)
                ? $nameImg = "perfil.png"//ACCION A EJECUTAR
                : $nameImg = $datos -> fotoPerfil;// REEMPLAZO DE ELSE
        }else{
            $nameImg = "perfil.png";
        }
        return view('index', compact('productos','id', 'nameImg'));
    }
}
