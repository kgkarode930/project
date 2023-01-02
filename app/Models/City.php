<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'u_cities';

    protected $fillable = [
        'state_id',
        'city_name',
        'city_code',
    ];

    protected  $hidden = [];

    protected $casts = [];


    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
