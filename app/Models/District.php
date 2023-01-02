<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'u_districts';

    protected $fillable = [
        'state_id',
        'district_name',
        'district_code',
        'active_status'
    ];

    protected  $hidden = [];

    protected $casts = [];


    /**
     * Relation with states
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
