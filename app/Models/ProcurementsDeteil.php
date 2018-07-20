<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcurementsDeteil extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'name',
    	'offers_period_end_lot',
    	'offers_period_end_lot',
    	'procurement_id'
    ];	
}
