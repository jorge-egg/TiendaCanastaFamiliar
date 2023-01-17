<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//obtener los productos para mostrarlos
    {
        $productos = Productos::paginate(20);//enviar los productos de 20 en 20
        return view('productos.index', compact('productos'));//retornar la vista con los productos cargados
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'referencia' => 'required',
            'precio' => 'required',
            'disponibilidad' => 'required',
           'imagenProducto' => 'required | image' //validacion de requerido y de archivos olo de imagenes
        ]);

            $img = $request -> file('imagenProducto'); //traer archivo
            $url = public_path('img/productos'); //crear url para guardar la imagen
            copy($img -> getRealPath(), $url."/".$request->input('referencia').".".$img->guessExtension());
            $guardar = $request -> input('referencia').".".$img -> guessExtension();
        Productos::create([
            'nombre'=>$request->input('nombre'),
            'img'=>$guardar,
            'precio'=>$request->input('precio'),
            'disponibilidad'=>$request->input('disponibilidad'),
            'referencia'=>$request->input('referencia'),
        ]);
        return redirect()->route('producto.index');

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
        $producto = Productos::findOrFail($id);
        return view('productos.editar', compact('producto'));
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
        $actualizar = Productos::FindOrFail($id);
        if($request->hasFile('imagenProducto')){
            Storage::delete(public_path('img/productos'.$actualizar->img));//borrar la imagen guardada
            $img = $request -> file('imagenProducto'); //traer archivo
            $url = public_path('img/productos'); //crear url para guardar la imagen
            copy($img -> getRealPath(), $url."/".$request->input('referencia').".".$img->guessExtension());
            $guardar = $request -> input('referencia').".".$img -> guessExtension();

            $actualizar -> img = $guardar;
            $actualizar->save();//guardar la imagen
            $actualizar->update($request->all());//guardar todos los datos restantes
        }else{
            $actualizar->update($request->all());
        }
        return redirect()->route("producto.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->delete();
        return redirect()->route("producto.index");
    }
}
