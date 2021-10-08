<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use App\State;
use App\Community;

class Project extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;

    protected $fillable =[
        'component_id',
        'category_id',
        'sub_category',
        'status_id',
        'why_not_functional',
        'amount_disbursed',
        'amount_spend',
        'number',
        'state_id',
        'lga_id',
        'community_id',
        'location',
        'longtitude',
        'latitude',
        'description',
    ];

    protected $guarded = [];

    /**
     * Get the state that the investment belongs to.
    */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    /*
    * Get community associated with this state
    */
    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}
