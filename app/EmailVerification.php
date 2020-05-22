<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    protected $fillable = [
        'key', 'user_id',
    ];

}
