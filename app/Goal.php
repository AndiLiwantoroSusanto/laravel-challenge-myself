<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goal extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'achived_at', 'is_not_lazy','started_at','total_day','user_id'
    ];

    protected $dates = ['deleted_at'];
}