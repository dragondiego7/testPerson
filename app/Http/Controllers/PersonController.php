<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Person;

class PersonController extends Controller
{
    public function index()
    {
        return Person::all();
    }
 
    public function show($id)
    {
        return Person::find($id);
    }

    public function store(Request $request)
    {
        return Person::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $person = Person::findOrFail($id);
        $person->update($request->all());

        return $person;
    }

    public function delete(Request $request, $id)
    {
        $person = Person::findOrFail($id);
        $person->delete();

        return 204;
    }
}
