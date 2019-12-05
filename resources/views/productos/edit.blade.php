@extends('layouts.app')

@section('content')

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Modificar producto
         </div>
         <div class="card-body" style="padding:30px">

         <form action="{{ action('ProductoController@putEdit') }}" method="POST" enctype="multipart/form-data">
         {{method_field('PUT')}}

            @csrf
            <input type="hidden" id="id" name="id" value="{{$producto->id}}">

            <div class="form-group">
               <label for="title">Nombre</label>
               <input type="text" name="nombre" id="nombre" value="{{$producto->nombre}}" class="form-control">
            </div>

            <div class="form-group">
            <label for="title">Precio</label>
               <input type="number" name="precio" id="precio" value="{{$producto->precio}}" class="form-control">
            </div>

            <div class="form-group">
            <label for="title">Categoria</label>
               <input type="text" name="categoria" id="categoria" value="{{$producto->categoria}}" class="form-control">
            </div>

            <div class="form-group">
               <label for="title">Seleccionar imagen:</label>
               <input type="file" id="imagen" name="imagen" class="form-control">
            </div>

            <div class="form-group">
               <label for="synopsis">Descripción</label>
               <textarea name="descripcion" id="descripcion" class="form-control" rows="3"> {{$producto->descripcion}}"</textarea>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Modificar producto
               </button>
            </div>

            </form>

         </div>
      </div>
   </div>
</div>

@stop