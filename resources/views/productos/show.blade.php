@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-sm-4">

        <img src="https://picsum.photos/200/300/" style="height:200px"/>

    </div>
    <div class="col-sm-8">

        <h2>{{ $producto[0] }}</h2>
        <h5>Categoria: {{ $producto[1] }}</h5>

            <p>Estado: Producto actualmente comprado</p>
            <button type="button" class="btn btn-danger">Pendiente de compra</button>


        <button type="button" class="btn btn-warning">Editar producto</button>
        <button type="button" class="btn btn-default">Volver al listado

    </div>
</div>

@stop