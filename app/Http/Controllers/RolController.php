<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolController extends Controller
{

    function __construct()//constructor encargado de especificar los permisos de cada rol
    {
        $this->middleware('permission: ver-productos|ver-despachos|ver-historial|ver-GesCuentas', ['only' => ['index']]);
        $this->middleware('permission: ver-productos', ['only' => ['create', 'edit','update', 'destroy', 'show']]);
        $this->middleware('permission: ver-despachos', ['only' => ['edit', 'update', 'show']]);
        $this->middleware('permission: ver-historial', ['only' => ['show']]);
        $this->middleware('permission: ver-GesCuentas', ['only' => ['destroy','edit']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request, ['name' => 'required', 'permission' => 'required']);

        $role = Role::find($id); // encontrar el dato con ese id
        $role -> name = $request -> input('name'); //obtener el nombre
        $role -> save(); //guardar datos

        $role -> syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
