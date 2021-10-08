<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use App\Lga;
use App\Status;
use App\State;
use App\Education;
use App\Welfare;
use App\Community;
use App\Ward;

class Beneficiary extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;

    protected $guarded = [];
    protected $with = ['education', 'benefit', 'status', 'community'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the lga that the community belongs to.
    */
    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }

    /**
     * Get the education level of the beneficiary.
     */
    public function education()
    {
        return $this->belongsTo(Education::class);
    }

    /**
     * Get the status type of the beneficiary.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the benefit associated with beneficiary.
     */
    public function benefit()
    {
        return $this->belongsTo(Welfare::class);
    }

    public function community(){
        return $this->belongsTo(Community::class);
    }
    public function ward(){
        return $this->belongsTo(Community::class);
    }

}
