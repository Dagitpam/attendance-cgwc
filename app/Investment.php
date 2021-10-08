<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use App\State;

class Investment extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $guarded = [];
    protected $with = ['state'];
    /**
     * Get the state that the investment belongs to.
    */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
