<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Beneficiary;

class Status extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;

    protected $fillable=['slug','name'];
    protected $cascadeDeletes = ['beneficiaries'];
    protected $dates = ['deleted_at'];

    /*
    *  Get beneficiaries within particular project status
    */
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }
}
