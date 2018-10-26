<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
     protected $table = 'tareas';
     public $timestamps = false;

      /**
     * Trae las tareas de una categoria.
     */
    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }
}
