<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
    	'results',
    	'procurement_id',
        'participants_id' 	
    ];


    public function participants()
    {
        return $this->belongsTo('App\Models\Participant');
    }
}
