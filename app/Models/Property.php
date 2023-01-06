<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','name','contact','address','city','zip_code','kind_of_property','area','total_valuation','property_status'];
    public function broker(){
        return $this->belongsToMany(User::class,'user_properties','property_id','user_id');
    }
}
