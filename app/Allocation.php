<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use App\State;

class Allocation extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;

    protected $guarded = [];
    protected $with = ['state'];
    /**
     * kkkk
     * Get the state that the allocation belongs to.
    */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
