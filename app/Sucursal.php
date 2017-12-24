<?php

namespace compusystem;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{


	protected $table='sucursal';

    protected $primaryKey='idsucursal';

    public $timestamps=false;


    protected $fillable =[
    	'idempresa',
    	'sucursal',
    	'direccion',
    	'departamento',
    	'telefono',
    	'celular',
    	'estado'
    ];
  	protected $guarded =[

    ];
}
