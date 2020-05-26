<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'name', 'achived_at', 'is_not_lazy','started_at','total_day','user_id'
    ];

}