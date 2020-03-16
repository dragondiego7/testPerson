<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $fillable = ['person_id', 'connection_id'];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function setPersonIdAttribute($value)
	{
	    $this->attributes['person_id'] = $value;
	}

	public function setConnectionIdAttribute($value)
	{
	    $this->attributes['connection_id'] = $value;
	}
}
