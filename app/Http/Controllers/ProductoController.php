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

    public function postCreate(Request $request){
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categoria = $request->input('categoria');
        $producto->imagen = $request->input('imagen');
        $producto->pendiente = false;
        $producto->descripcion = $request->input('descripcion');
        $producto->save();
        return redirect(action('ProductoController@getIndex'));
    }

    public function putEdit(Request $request){
        $producto = Producto::findOrFail($request->input('id'));
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categoria = $request->input('categoria');
        $producto->imagen = $request->input('imagen');
        $producto->descripcion = $request->input('descripcion');
        $producto->save();

        return redirect(action('ProductoController@getShow', ['id' => $producto->id]));
    }

    
}
