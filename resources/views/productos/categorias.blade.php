@extends('layouts.app')

@section('content')

<div class="row">
        <ul>
    @foreach( $arrayCategorias as $categoria )
            <li><a href="{{ url('productos/' . $categoria->categoria ) }}">
                    {{$categoria->categoria}}                
                </a>
            </li>
    @endforeach
        </ul>
</div>

@stop