<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use App\State;


class Transport extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;

    protected $guarded = [];

    /**
     * Get the state that the communnication publication belongs to.
    */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
