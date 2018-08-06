<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcurementsDeteil extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'name',
    	'offers_period_end_lot',
    	'auction_period_end_lot',
    	'amount_lot',
    	'procurement_id'
    ];

    public function procurements()
    {
        return $this->belongsTo('App\Models\Procurement');
    }	
}
