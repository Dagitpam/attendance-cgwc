<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class C2beneficiary extends Model
{
    use HasFactory,CascadeSoftDeletes;

    // SoftDeletes

    protected $guarded = [];
    // protected $with = ['benefit_id', 'beneficiaries'];
}
