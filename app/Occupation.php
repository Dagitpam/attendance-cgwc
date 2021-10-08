<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Occupation extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;

    protected $with = ['name'];
}
