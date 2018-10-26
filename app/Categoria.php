<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
     protected $table = 'categorias';
     public $timestamps = false;

      /**
     * Trae la categoria de una tarea.
     */
    public function tareas()
    {
        return $this->hasMany('App\Tarea');
    }
}
