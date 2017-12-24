<?php

namespace compusystem;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table='empresa';

    protected $primaryKey='idempresa';

    public $timestamps=false;


    protected $fillable =[
    	'nombre',
    	'representante_legal',
    	'razon_social',
    	'actividad_economica',
    	'nit',
    	'imagen'
    ];

    protected $guarded =[

    ];
}
