<?php

namespace compusystem;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
   protected $table='tipo_usuario';

    protected $primaryKey='idtipo_usuario';

    public $timestamps=false;


    protected $fillable =[
    	'nombre',
    	'estado'
    ];

    protected $guarded =[

    ];
}




