<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Beneficiary;

class Education extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;

    protected $fillable = ['slug', 'education_level'];
    protected $cascadeDeletes = ['beneficiaries'];
    protected $dates = ['deleted_at'];

    /*
    *  Get beneficiaries with particular education level
    */
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }
}
