@extends('layouts.app')

@section('content')

<div class="row">
        <ul>
    @foreach( $arrayCategorias as $categoria )
            <li><a href="{{ url('categorias/' . $categoria->categoria ) }}">
                    {{$categoria->categoria}}                
                </a>
            </li>
    @endforeach
        </ul>
</div>

@stop