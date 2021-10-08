<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\State;
use App\Community;

class Lga extends Model
{
    use HasFactory;

    /**dddd
     * Get the state that owns the local goverment.
    */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /*
    *  Get communities associated with this lga
    */
    public function communities()
    {
        return $this->hasMany(Community::class);
    }
}
