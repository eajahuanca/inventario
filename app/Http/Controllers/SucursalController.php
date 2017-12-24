<?php

namespace compusystem\Http\Controllers;

use Illuminate\Http\Request;

use compusystem\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use compusystem\Http\Requests\SucursalFormRequest;
use compusystem\Sucursal;
use compusystem\Empresa;

use DB;

use Fpdf;

class SucursalController extends Controller
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
            $sucursal=DB::table('sucursal as s')
            ->join('empresa as e','s.idempresa','=','e.idempresa')
            ->select('s.idsucursal','e.nombre as empresa','s.sucursal','s.direccion','s.departamento','s.telefono','s.celular','s.estado')
            ->where('s.sucursal','LIKE','%'.$query.'%')
            ->orderBy('s.idsucursal','desc')
            ->paginate(10);
            return view('entidad.sucursal.index',["sucursal"=>$sucursal,"searchText"=>$query]);
        }
    }
    public function create()
    {
        $empresa=DB::table('empresa')->where('estado','=','Funcionamiento')->get();
        return view("entidad.sucursal.create",["empresa"=>$empresa]);
    }
    public function store (SucursalFormRequest $request)
    {
        $sucursal=new Sucursal;
        $sucursal->idempresa=$request->get('idempresa');
        $sucursal->sucursal=$request->get('sucursal');
        $sucursal->direccion=$request->get('direccion');
        $sucursal->departamento=$request->get('departamento');
        $sucursal->telefono=$request->get('telefono');
        $sucursal->celular=$request->get('celular');
        $sucursal->estado='Activo';
        $sucursal->save();
        return Redirect::to('entidad/sucursal');

    }
    public function show($id)
    {
        return view("entidad.sucursal.show",["sucursal"=>Sucursal::findOrFail($id)]);
    }


    public function edit($id)
    {
        $sucursal=Sucursal::findOrFail($id);
        $empresa=DB::table('empresa')->where('estado','=','Funcionamiento')->get();
        return view("entidad.sucursal.edit",["sucursal"=>$sucursal,"empresa"=>$empresa]);
    }

    public function update(SucursalFormRequest $request,$id)
    {
        $sucursal=Sucursal::findOrFail($id);

        $sucursal->idempresa=$request->get('idempresa');
        $sucursal->sucursal=$request->get('sucursal');
        $sucursal->direccion=$request->get('direccion');
        $sucursal->departamento=$request->get('departamento');

        $sucursal->telefono=$request->get('telefono');
        $sucursal->celular=$request->get('celular');
        $sucursal->estado='Activo';

        $sucursal->update();
        return Redirect::to('entidad/sucursal');
    }
    public function destroy($id)
    {
        $sucursal=Sucursal::findOrFail($id);
        $sucursal->estado='Inactivo';
        $sucursal->update();
        return Redirect::to('entidad/sucursal');
    }
}
