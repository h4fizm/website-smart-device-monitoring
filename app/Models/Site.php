<?php
// app/Models/Site.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $table = 'sites';

    protected $primaryKey = 'id_sites'; // Specify the actual primary key column name

    protected $fillable = ['name', 'latitude', 'longitude'];
}
