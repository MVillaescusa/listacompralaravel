<?php

namespace App\Http\Controllers;

use App\Producto;
use App\ProductoUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($categoria = "categorias") {

        $productos = Producto::all();
        return view('productos.index', array('arrayProductos' => $productos));

        /*return view('productos.index', array('arrayProductos'=>$this->arrayProductos));*/
    }

    public function getCategorias() {
        $categorias = Producto::select('categoria')->distinct()->get();
        return view('productos.categorias', array('arrayCategorias' => $categorias));
    }

    public function getCategoria($categoria) {
        $productos = Producto::where('categoria', $categoria)->get();
        if ($productos) {
            return view('productos.index', array('arrayProductos' => $productos));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categoria = $request->input('categoria');
        if ($request->exists('imagen')) {
            $producto->imagen = Storage::disk('public')->putFile('imagenes', $request->file('imagen'));
        }
        $producto->descripcion = $request->input('descripcion');
        $producto->save();
        return redirect(action('ProductoController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto) {
        try {
            $compra = ProductoUser::where('producto_id', $producto->id)->where('user_id', auth()->id())->firstOrFail();
        } catch (\Throwable $th) {
            $compra = null;
        }
        return view('productos.show', array(
            'producto' => $producto,
            'id' => $producto->id,
            'compra' => $compra,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto) {
        return view('productos.edit', array(
            'producto' => $producto,
            'id' => $id,
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto) {
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categoria = $request->input('categoria');
        if ($request->exists('imagen')) {
            $producto->imagen = Storage::disk('public')->putFile('imagenes', $request->file('imagen'));
        }
        $producto->descripcion = $request->input('descripcion');
        $producto->save();

        return redirect(action('ProductoController@show', ['producto' => $producto]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto) {
        $producto->delete();
        Storage::disk('public')->delete($producto->imagen);
        return redirect(action('ProductoController@index'));
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

        return redirect(action('ProductoController@show', ['producto' => $request->input('id')]));
    }
}
