<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
    	'id',
        'identifier',
    	'customer',
    	'id_procurement',
    	'offers_period_end',
    	'auction_period_end',
    	'amount',
    	'description',
    	'subjects_id',
        'statuses_id',
    	'types_id',
        'users_id',
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function statuses()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function procurement_statuses()
    {
        return $this->belongsTo('App\Models\ProcurementStatus');
    }

    public function subjects()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function types()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }

    public function diff($value)
    {
        Carbon::setLocale('ru');
        $diff = Carbon::now()->diffForHumans($value);
        return $diff;
    }

    public function scopeSearch($query, $search) 
    {
        return $query->where('id_procurement', 'like', '%' .$search. '%');
    }
    
}
