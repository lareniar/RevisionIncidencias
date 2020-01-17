<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    //
    protected $table='incidencias';
    protected $fillable = [
        'id', 'cod_incidencia', 'cod_equipo','descripcion','aula', 'user_id', 'admin_id','estado','tipo_equipo', 
    ];
}
