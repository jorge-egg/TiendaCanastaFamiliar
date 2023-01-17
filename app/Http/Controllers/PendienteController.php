<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Detalle;
use App\Models\Pedidos;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendienteController extends Controller
{
    public function __construct(){
        $this->middleware('can:adm-pedidos')->only('index','edit', 'update','mostrarDetalle', 'indexHistorial');

    }

    public function index()
    {
        $productsCart=Pedidos::join('usuarios', 'usuarios.idUsuario', 'Pedidos.idUsuario_cliente')->get();/*join(tabla en bd a donde ingreso, campos a comprar 1, campo a comprara 2)->where('users.id', $id)*/
        return view('pedidos.index', compact('productsCart'));
    }

    public function store(Request $request)
    {
        $idUsu = Auth::id();
        $detalles = Carro::where('idUsuario',$idUsu)->get();//extraer los dato del carro segun sea el id del ususario

        Pedidos::create([
            'idUsuario_despachador'=> null,
            'idUsuario_cliente'=> $idUsu,
            'estado'=>false
        ]);

        $idPedido = Pedidos::where('idUsuario_cliente',$idUsu)->orderBy('idPedido', 'desc')->first();//extraer el id del pedido segun sea el id del cliente en orden tal que se tome el ultimo id
        foreach ($detalles as $detalle) {//pasar los productos a la tabla de detalle
            $producto = Productos::findOrFail($detalle->idProducto);
            $producto->update(['disponibilidad' => ($producto->disponibilidad) - ($detalle->cantidad)]);
            Detalle::create([
            'idPedido'=>$idPedido->idPedido,
            'idProducto'=>$detalle->idProducto,
            'cantidad' => $detalle->cantidad,
            'precioTotal' =>$detalle->cantidad * $detalle->precio
            ]);
        }

        $detalles = Carro::where('idUsuario',$idUsu)->delete();//borrar lo productos del carro


        return redirect()->route('index')->with('comprado','ok');
    }


    public function mostrarDetalle(Request $request, $id){
        $datos = Detalle::where('idPedido', $id)->get();
        $productos = Detalle::join('productos', 'productos.idProducto', 'detallepedido.idProducto')->where('idPedido', $id)->get();//extraer los productos que tengan el mismo id que los productos añadidos e la tabla de detalles

        return view('pedidos.detalle', compact('productos'));
    }

    public function update(Request $request, $id){
        $pedido = Pedidos::findOrFail($id);
        $pedido->estado = true;
        $pedido->idUsuario_despachador = Auth::id();
        $pedido->save();
        return redirect()->route('pendientes.index');
    }

    public function indexHistorial()
    {
        $productsCart=Pedidos::join('usuarios', 'usuarios.idUsuario', 'Pedidos.idUsuario_cliente')->get();/*join(tabla en bd a donde ingreso, campos a comprar 1, campo a comprara 2)->where('users.id', $id)*/
        $despachador = Auth::id();
        return view('pedidos.historial', compact('productsCart', 'despachador'));
    }

}
