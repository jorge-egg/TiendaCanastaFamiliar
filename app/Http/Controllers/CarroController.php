<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Carro;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total=0;
        $id = Auth::id();
       if($id==null){
        return redirect()->route('index');
       }//si no esta logueado entonces no permitir acceso al carrito
        $productsCart=Carro::join('users', 'users.id', 'carro.idUsuario')->join('productos', 'productos.idProducto', 'carro.idProducto')->where('users.id', $id)->get();/*join(tabla en bd a donde ingreso, campos a comprar 1, campo a comprara 2)->where('users.id', $id)*/
        foreach($productsCart as $productoTotal){
            $total = $total + $productoTotal->total;
        }
        return view('carro', compact('productsCart', 'total'));
    }
//join(tabla a la que se va a ir, id de tabla, id de la tabla actual)
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
    public function store(Request $request, $id)
    {
        $idUsu = Auth::id();
        if($idUsu == null){//verificar que el usuario halla iniciado seccion
            return redirect()->route('index');
        }
        Carro::create([
            'idProducto'=> $id,
            'idUsuario'=> $idUsu,
            'precio'=>$request->input('precio'),
            'cantidad'=> 1,
            'total'=>$request->input('precio')
        ]);
        return redirect()->route('carro.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Carro::FindOrFail($id);
        $producto->delete();
        return redirect()->route('carro.index');
    }

    public function aumento($id){
        $producto = Carro::findOrFail($id);
        $producto->cantidad = ($producto->cantidad)+1;
        $producto->total = ($producto->total)+$producto->precio;
        $producto->save();
        return redirect()->route('carro.index');
    }

    public function disminucion($id){
        $producto = Carro::findOrFail($id);
        if($producto->cantidad == 1){
            $producto = Carro::FindOrFail($id);
            $producto->delete();
            return redirect()->route('carro.index');
        }else{
            $producto->cantidad = ($producto->cantidad)-1;
            $producto->total = ($producto->total)-$producto->precio;
            $producto->save();
        }

        return redirect()->route('carro.index');
    }

}
