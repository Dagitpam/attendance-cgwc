<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Component extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;

    protected $fillable =['name', 'description'];
    // protected $cascadeDeletes = ['components'];
    protected $dates = ['deleted_at'];


}
