<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
    	'results',
    	'amount',
    	'procurement_id',
    	'won_by_price_id',
    	'winners_id',
    	'winner_amount',
    ];


    public function winners()
    {
        return $this->belongsTo('App\Models\Participant', 'winners_id');
    }

    public function wonByPrice()
    {
        return $this->belongsTo('App\Models\Participant', 'won_by_price_id');
    }
}
