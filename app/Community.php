<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use App\State;
use App\Lga;
use App\Beneficiary;
use App\Project;

class Community extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug','name','longtitude','latitude','state_id', 'lga_id',
    ];
    protected $cascadeDeletes = ['beneficiaries'];
    protected $dates = ['deleted_at'];

    /**
     * Get the state that the community belongs to.
    */
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

    /*
    *  Get beneficiaries from this particular community
    */
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }
    /*
    * Get community associated with this state
    */
    public function project()
    {
        return $this->hasmany(Project::class);
    }
}
