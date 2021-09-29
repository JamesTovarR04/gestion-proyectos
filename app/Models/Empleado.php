<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Empleado extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'empleados';

    public $timestamps = false;
}
