<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function session()
    {
        return $this->hasOne(Session::class,'id','session_id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
