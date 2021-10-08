<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
