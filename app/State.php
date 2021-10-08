<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use App\Lga;
use App\Community;
use App\Beneficiary;
use App\Allocation;
use App\Investment;
use App\Project;
use App\Social;
use App\Training;
use App\Feedback;
use App\Complain;
use App\Communication;
use App\Transport;
use App\Wash;
use App\Pump_Borehole;
use App\School;
use App\Classroom;

class State extends Model
{
    use HasFactory,CascadeSoftDeletes;

    /**
     * Get all local goverment areas for this state.
    */
    protected $with = ['beneficiaries'];
    public function lgas()
    {
        return $this->hasMany(Lga::class);
    }

    /*
    *  Get communities associated with this state
    */
    public function communities()
    {
        return $this->hasMany(Community::class);
    }

    /*
    *  Get beneficiaries associated with this state
    */
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    /*
    *  Get allocations associated with this state
    */
    public function allocation()
    {
        return $this->hasMany(Allocation::class);
    }
    
    /*
    *  Get investment associated with this state
    */
    public function investment()
    {
        return $this->hasMany(Investment::class);
    }

    /*
    *  Get project associated with this state
    */
    public function project()
    {
        return $this->hasMany(Project::class);
    }

    /*
    *  Get Social Support associated with this state
    */
    public function social()
    {
        return $this->hasMany(Social::class);
    }


    /*
    *  Get Peace group associated with this state
    */
    public function peace()
    {
        return $this->hasMany(Peace::class);
    }

    /*
    *  Get Trainee associated with this state
    */
    public function training()
    {
        return $this->hasMany(Training::class);
    }

    /*
    *  Get feedbacks associated with this state
    */
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    /*
    *  Get complains associated with this state
    */
    public function complain()
    {
        return $this->hasMany(Complain::class);
    }
   
    /*
    *  Get complains associated with this state
    */
    public function communication()
    {
        return $this->hasMany(Communication::class);
    }

    /*
    *  Get Transport Infrastructure associated with this state
    */
    public function transport()
    {
        return $this->hasMany(Transport::class);
    }

    /*
    *  Get Wash Infrastructure associated with this state
    */
    public function wash()
    {
        return $this->hasMany(Wash::class);
    }

    /*
    *  Get Wash Infrastructure associated with this state
    */
    public function pump_borehole()
    {
        return $this->hasMany(Pump_Borehole::class);
    }

    /*
    *  Get School associated with this state
    */
    public function school()
    {
        return $this->hasMany(School::class);
    }

    /*
    * Get Classroom associated with this state
    */
    public function classroom()
    {
        return $this->hasMany(Classroom::class);
    }
     
    /*
    * Get Scorecard associated with this state
    */
    public function scorecard()
    {
        return $this->hasMany(Scorecard::class);
    }
}
