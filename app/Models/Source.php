<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = [
        'id_device',
        'voltage',
        'current',
        'power',
        'temperature',
        'operation_time',
    ];
}
