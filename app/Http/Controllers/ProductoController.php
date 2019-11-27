<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    function getIndex(){
        $productos = Producto::all();
        return view('productos.index', array('arrayProductos'=>$productos));
        /*return view('productos.index', array('arrayProductos'=>$this->arrayProductos));*/
    }

    public function getShow($id){
        $producto = Producto::findOrFail($id);
        return view('productos.show', array(
            'producto' => $producto,
            'id' => $id,
        ));
        /*return view('productos.show', array('producto'=>$this->arrayProductos[$id]));*/
    }

    public function getCreate(){
        return view('productos.create');
    }

    public function getEdit($id){
        $producto = Producto::findOrFail($id);
        return view('productos.edit', array(
            'producto' => $producto,
            'id' => $id,
        ));
        /*return view('productos.edit', array('producto'=>$this->arrayProductos[$id]));*/
    }

    
}
