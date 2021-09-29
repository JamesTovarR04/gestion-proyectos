<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Proyecto extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'proyectos';

    public $timestamps = false;
}
