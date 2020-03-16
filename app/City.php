<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['person_id', 'name', 'value'];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function setPersonIdAttribute($value)
	{
	    $this->attributes['person_id'] = $value;
	}

	public function setNameAttribute($value)
	{
	    $this->attributes['name'] = $value;
	}

	public function setValueAttribute($value)
	{
	    $this->attributes['value'] = $value;
	}
}
