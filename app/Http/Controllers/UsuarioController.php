<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UsuarioController extends Controller
{

    public function __construct(){
        $this->middleware('can:adm-btn-editCuenta')->only('edit', 'update');
        $this->middleware('can:adm-btn-destroyCuenta')->only('store', 'destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//traer a los usuarios de 10 en 10
    {
        $usuarios = Usuarios::join('model_has_roles','model_has_roles.model_id', 'usuarios.idUsuario')->where('role_id',3)->get();
        return view('usuarios.index', compact('usuarios'));//pasar datos a la vista index de la carpeta usuarios
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//asignacion del rol de supervisor
    {
        $user = User::findOrFail($request->idRoleUsu);
        $user->removeRole('Cliente');
        $user->assignRole('Supervisor');
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Usuarios::findOrFail($id);
        return view('usuarios.editar', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuarios::findOrFail($id);//buscar el usuario con ese id y poner sus datos en la variabe $usuario
        $usuario -> nombre = $request->input('nombre');
        $usuario -> telefono = $request->input('telefono');
        $usuario -> direccion = $request->input('direccion');
        $usuario -> correo = $request->input('correo');

        $usuario -> save();
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuarios::findOrFail($id);
        $user = User::findOrFail($id);
        $usuario->delete();
        $user->delete();
        return redirect()->route('usuarios.index');
    }
}
