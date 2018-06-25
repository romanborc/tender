<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcurementStatus extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'status'
    ];
}
