<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultStatus extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'status',
    ];
}
