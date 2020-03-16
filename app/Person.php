<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['first_name', 'sur_name', 'age', 'gender'];

	//protected $table = 'persons';

    public function setFirsNameAttribute($value)
	{
	    $this->attributes['first_name'] = $value;
	}

	public function setSurNameAttribute($value)
	{
	    $this->attributes['sur_name'] = $value;
	}

	public function setAgeAttribute($value)
	{
	    $this->attributes['age'] = $value;
	}

	public function setGenderAttribute($value)
	{
	    $this->attributes['gender'] = $value;
	}

	public function connections()
    {
        return $this->hasMany('App\Connection');
    }

    public function cities()
    {
        return $this->hasMany('App\City');
    }
}
