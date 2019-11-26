@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-sm-4">

        <img src="https://picsum.photos/500/300/" style="height:200px"/>

    </div>
    <div class="col-sm-8">

        <h2>{{ $producto->nombre }}</h2>
        <h5>Categoria: {{ $producto->categoria }}</h5>

            <p>Estado: Producto actualmente comprado</p>
            <button type="button" class="btn btn-danger">Pendiente de compra</button>


            <a class="btn btn-warning" href="{{ url('/productos/edit/' . $producto->id ) }}">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                Editar producto</a>
        <button type="button" class="btn btn-default">Volver al listado</button>

    </div>
</div>

@stop