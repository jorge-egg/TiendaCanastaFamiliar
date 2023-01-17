@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/carro.css')}}">
@stop

@section('content')
    <div class="cont-general">
        @foreach ($productsCart as $productCart)
            <div class="contenedor">
                <div class="cont-img">
                    <img class="img-producto" src="img/productos/{{$productCart->img}}" alt="">
                </div>
                <div class="cont-aumento">
                    <form action="{{route('disminucion', $productCart->idCarro)}}" method="POST">
                        @csrf
                        <button class="btn-disminucion" type="submit"><i class="fa-solid fa-minus"></i></button>
                    </form>
                    <form action="{{route('aumento', $productCart->idCarro)}}" method="POST">
                        @csrf
                        <button class="btn-aumento" type="submit"><i class="fa-solid fa-plus"></i></button>
                    </form>
                </div>
                <form action="{{route('destroy', $productCart->idCarro)}}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-eliminar" type="submit">Eliminar</button>
                </form>
                <div class="dato-producto">
                    <h5>{{$productCart->nombre}}</h5>
                    <p>Valor por unidad: ${{$productCart->precio}}</p>
                    <p>Cantidad: {{$productCart->cantidad}}</p>
                    <p>Total: {{$productCart->total}}</p>
                </div>
            </div>


        @endforeach
    </div>
    <div class="cont-env">

        <h4 id="valorTotal">Valor a pagar: {{$total}}</h4>
        <form action="{{route('pendientes.store')}}" method="post">
            @csrf
            <button id="btn-confirmarCompra" type="submit">Finalizar compra</button>
        </form>
    </div>
@stop
