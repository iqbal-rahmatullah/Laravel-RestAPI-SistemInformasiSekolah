<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Matakuliah extends Model
{
    protected $connection = "mongodb";
    protected $collection = "matakuliah";
    protected $fillable = [
        "nama_matkul",
    ];
}
