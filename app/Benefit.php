<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use App\Beneficiary;

class Benefit extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;

    protected $fillable =['slug','name', 'component_id', 'default_number'];
    protected $cascadeDeletes = ['beneficiaries'];
    protected $dates = ['deleted_at'];
    /*
    *  Get beneficiaries with particular benefit
    */
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }
}
