<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'u_states';

    protected $fillable = [
        'country_id',
        'state_name',
        'state_code',
        'active_status'
    ];


    protected  $hidden = [];

    protected $casts = [];

    /**
     * Relation with Country
     */
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
}
