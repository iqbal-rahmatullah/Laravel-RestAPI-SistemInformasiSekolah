<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Kelas extends Model
{
    protected $connection = "mongodb";
    protected $collection = "kelas";

    protected $fillable = ["nama"];
}
