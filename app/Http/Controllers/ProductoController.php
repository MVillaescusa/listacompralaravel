<?php

namespace App\Http\Controllers;

use App\Producto;
use App\ProductoUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller {
    function getIndex($categoria = "categorias") {
        if (isset($categoria) && $categoria != "categorias") {
            $productos = Producto::where('categoria', $categoria)->get();
            return view('productos.index', array('arrayProductos' => $productos));
        } else {
            $productos = Producto::all();
            return view('productos.index', array('arrayProductos' => $productos));
        }
        /*return view('productos.index', array('arrayProductos'=>$this->arrayProductos));*/
    }

    public function getCategorias() {
        $categorias = Producto::select('categoria')->distinct()->get();
        return view('productos.categorias', array('arrayCategorias' => $categorias));
    }

    public function getShow($id) {
        $producto = Producto::findOrFail($id);
        try {
            $compra = ProductoUser::where('producto_id', $id)->where('user_id', auth()->id())->firstOrFail();
        } catch (\Throwable $th) {
            $compra = null;
        }
        return view('productos.show', array(
            'producto' => $producto,
            'id' => $id,
            'compra' => $compra,
        ));
        /*return view('productos.show', array('producto'=>$this->arrayProductos[$id]));*/
    }

    public function getCreate() {
        return view('productos.create');
    }

    public function getEdit($id) {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', array(
            'producto' => $producto,
            'id' => $id,
        ));
        /*return view('productos.edit', array('producto'=>$this->arrayProductos[$id]));*/
    }

    public function postCreate(Request $request) {
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categoria = $request->input('categoria');
        if ($request->exists('imagen')) {
            $producto->imagen = Storage::disk('public')->putFile('imagenes', $request->file('imagen'));
        }
        $producto->pendiente = false;
        $producto->descripcion = $request->input('descripcion');
        $producto->save();
        return redirect(action('ProductoController@getIndex'));
    }

    public function putEdit(Request $request) {
        $producto = Producto::findOrFail($request->input('id'));
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categoria = $request->input('categoria');
        if ($request->exists('imagen')) {
            $producto->imagen = Storage::disk('public')->putFile('imagenes', $request->file('imagen'));
        }
        $producto->descripcion = $request->input('descripcion');
        $producto->save();

        return redirect(action('ProductoController@getShow', ['id' => $producto->id]));
    }

    public function changeSelled(Request $request) {
        try {
            $compra = ProductoUser::where('producto_id', '=', $request->input('id'))->where('user_id', '=', auth()->id())->firstOrFail();
            $compra->delete();
        } catch (\Throwable $th) {
            $compra = new ProductoUser;
            $compra->producto_id = $request->input('id');
            $compra->user_id = auth()->id();
            $compra->save();
        }

        return redirect(action('ProductoController@getShow', ['id' => $request->input('id')]));
    }

}
