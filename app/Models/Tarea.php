<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Tarea extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'tareas';

    public $timestamps = false;
}
