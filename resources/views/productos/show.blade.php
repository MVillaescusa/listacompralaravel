@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-4">

        <img src="{{asset('storage/' . $producto->imagen)}}" style="height:200px"/>

    </div>
    <div class="col-sm-8">

        <h2>{{ $producto->nombre }}</h2>
        <h5>Categoria: {{ $producto->categoria }}</h5>

        <form action="{{action('ProductoController@changeSelled')}}" method="POST">
            {{method_field('PUT')}}
            @csrf

            <input type="hidden" id="id" name="id" value="{{$producto->id}}">
            @if ((isset($compra)) && ($compra->user_id == auth()->id()))
                <p>Estado: Producto en la lista de la compra</p>
                <button type="submit" class="btn btn-primary">Comprado</button>
            @else 
                <p>Estado: Producto comprado</p>
                <button type="submit" class="btn btn-primary">Añadir a la lista</button>
            @endif
            <a class="btn btn-warning" href="{{ url('/productos/edit/' . $producto->id ) }}">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                Editar producto</a>
        <button type="button" class="btn btn-default">Volver al listado</button>
        </form>  

        <form action="{{action('ProductoController@destroy', ['producto' => $producto])}}" method="POST">
            {{method_field('DELETE')}}
            @csrf
            <button type="submit" onclick="return confirm('¿Seguro que desea eliminar ésta película?')" class="btn btn-danger">Eliminar producto</button>
        </form>  
    </div>
</div>

@stop