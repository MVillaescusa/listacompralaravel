<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function getHome(){
        return redirect()->action('ProductoController@getIndex');
    }
}
