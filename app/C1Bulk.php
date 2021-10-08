<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C1Bulk extends Model
{
    use HasFactory;

    protected $fillable = ['title','state_id', 'welfare_id', 'male_participants', 'female_participants', 'date'];

    public function state(){
        return $this->belongsTo('App\State');
    }

    public function welfare(){
        return $this->belongsTo('App\Welfare');
    }
}
