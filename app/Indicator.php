<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'target',
        'upper_limit',
        'borno',
        'adamawa',
        'yobe',
        'comments',
    ];
}
