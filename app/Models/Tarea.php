<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Tarea extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'tareas';

    public $timestamps = false;

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
