<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use App\State;


class Pump_Borehole extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;

    protected $guarded = [];

    /**
     * Get the state that the wash infrastructure belongs to.
    */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
