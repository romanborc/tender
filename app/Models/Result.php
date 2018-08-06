<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'lot_number',
    	'results',
    	'amount',
    	'procurement_id',
    	'won_by_price_id',
    	'winners_id',
    	'winner_amount',
        'statuses_id',
    ];


    public function winners()
    {
        return $this->belongsTo('App\Models\Participant', 'winners_id');
    }

    public function wonByPrice()
    {
        return $this->belongsTo('App\Models\Participant', 'won_by_price_id');
    }

    public function results_statuses()
    {
        return $this->belongsTo('App\Models\ResultStatus');
    }
}
