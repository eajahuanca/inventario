<?php

namespace compusystem;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table='users';

    protected $primaryKey='id';
    
    protected $fillable = [
        'idtipo_usuario','name', 'email', 'password', 'imagen', 'ap_paterno', 'fecha_nacimiento', 'genero','estado', 'ci',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}



