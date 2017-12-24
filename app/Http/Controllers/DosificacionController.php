<?php

namespace compusystem\Http\Controllers;

use Illuminate\Http\Request;

use compusystem\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use compusystem\Http\Requests\DosificacionFormRequest;
use compusystem\Empresa;

use compusystem\Dosificacion;
use DB;

use Fpdf;

class DosificacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $dosificacion=DB::table('dosificacion as d')
            ->select('d.iddosificacion','d.nro_autorizacion','d.llave','d.fecha_limite_emision','d.estado')
            ->where('d.nro_autorizacion','LIKE','%'.$query.'%')
            ->orderBy('d.iddosificacion','desc')
            ->paginate(10);
            return view('entidad.dosificacion.index',["dosificacion"=>$dosificacion,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("entidad.dosificacion.create");
    }
    public function store (DosificacionFormRequest $request)
    {
        $dosificacion=new Dosificacion;
        $dosificacion->nro_autorizacion=$request->get('nro_autorizacion');
        $dosificacion->llave=$request->get('llave');
        $dosificacion->fecha_limite_emision=$request->get('fecha_limite_emision');
        $dosificacion->estado='Activo';
        $dosificacion->save();
        return Redirect::to('entidad/dosificacion');

    }
    public function show($id)
    {
        return view("entidad.dosificacion.show",["dosificacion"=>Dosificacion::findOrFail($id)]);
    }


    public function edit($id)
    {
        $dosificacion=Dosificacion::findOrFail($id);
        return view("entidad.dosificacion.edit",["dosificacion"=>$dosificacion]);
    }

 public function update(DosificacionFormRequest $request, $id)
    {
        $dosificacion=Dosificacion::findOrFail($id);
        $dosificacion->nro_autorizacion=$request->get('nro_autorizacion');
        $dosificacion->llave=$request->get('llave');
        $dosificacion->fecha_limite_emision=$request->get('fecha_limite_emision');
        $dosificacion->estado='Activo';
        $dosificacion->update();
        return Redirect::to('entidad/dosificacion');
    }
    public function destroy($id)
    {
        $dosificacion=Dosificacion::findOrFail($id);
        $dosificacion->estado='Inactivo';
        $dosificacion->update();
        return Redirect::to('entidad/dosificacion');
    }
}
