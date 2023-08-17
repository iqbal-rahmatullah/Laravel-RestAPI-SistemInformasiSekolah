<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Siswa extends Model
{
    protected $connection = "mongodb";
    protected $collection = "siswa";

    protected $fillable = [
        "nim", "nama", "kelas"
    ];
}
