@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Detalle de pedido</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/carro.css')}}">
@stop

@section('content')
<div class="cont-general">
    @foreach ($productos as $productCart)
        <div class="contenedor">
            <div class="cont-img">
                <img class="img-producto" src="{{asset("img/productos/$productCart->img")}}" alt="">
            </div>

            <div class="dato-producto">
                <h5>{{$productCart->nombre}}</h5>
                <p>Valor por unidad: ${{$productCart->precio}}</p>
                <p>Cantidad: {{$productCart->cantidad}}</p>
                <p>Total: ${{$productCart->cantidad * $productCart->precio}}</p>
            </div>
        </div>
    @endforeach
</div>
@stop
