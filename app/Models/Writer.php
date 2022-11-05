<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Writer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "name",
        "lastname",
        "info",
        "image",
//        "is_active",
    ];
}
