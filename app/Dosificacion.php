<?php

namespace compusystem;

use Illuminate\Database\Eloquent\Model;

class Dosificacion extends Model
{
	protected $table='dosificacion';

    protected $primaryKey='iddosificacion';

    public $timestamps=false;


    protected $fillable =[
    	'nro_autorizacion',
    	'llave',
    	'fecha_limite_emision',
    	'estado'
    ];
  	protected $guarded =[

    ];
}
