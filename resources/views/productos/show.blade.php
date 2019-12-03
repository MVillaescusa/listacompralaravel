@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-4">

        <img src="https://picsum.photos/500/300/" style="height:200px"/>

    </div>
    <div class="col-sm-8">

        <h2>{{ $producto->nombre }}</h2>
        <h5>Categoria: {{ $producto->categoria }}</h5>

        <form action="{{action('ProductoController@changeSelled')}}" method="POST">
            {{method_field('PUT')}}
            @csrf

            <input type="hidden" id="id" name="id" value="{{$producto->id}}">
            @if ($producto->pendiente)
                <p>Estado: Producto pendiente de compra</p>
                <button type="submit" class="btn btn-primary">Comprar</button>
            @else 
                <p>Estado: Producto actualmente comprado</p>
                <button type="submit" class="btn btn-danger">Devolver</button>
            @endif
            <a class="btn btn-warning" href="{{ url('/productos/edit/' . $producto->id ) }}">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                Editar producto</a>
        <button type="button" class="btn btn-default">Volver al listado</button>
        </form>  

    </div>
</div>

@stop