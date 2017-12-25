<?php

namespace compusystem\Http\Controllers;

use Illuminate\Http\Request;

use compusystem\Http\Requests;
use compusystem\Articulo;

class NotificationController extends Controller
{
    public function __construct(){}
    public function index(){
        $stock = Articulo::where('estado','=','Activo')->where('alerta_stock','=',1)->get();
        if(count($stock) > 0){
            return \Response::json($stock);
        }
        return null;
    }
}
