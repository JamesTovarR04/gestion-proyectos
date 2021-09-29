<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Documento extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'documentos';

    public $timestamps = false;
}
