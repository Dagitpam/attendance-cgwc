<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_sub_category extends Model
{
    use HasFactory;

    protected $fillable = ['project_category_id', 'name'];
}
