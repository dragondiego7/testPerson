<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Person;
use App\Connection;
use App\City;

class loadFlux extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:flux';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to load data form array';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump("BEGIN FLUX");

        $dataPersons = $this->returnData();

        //$contents = Storage::get('public/socialGraph.php');
        //$contents = str_replace(array("\n"), "", $contents);
        //$contents = json_encode($contents);
        //$contents = json_decode($contents, true);
        //dump($dataPersons);

        dump("Start Load Data");

        // Loop all persons to save in database
        foreach ($dataPersons as $key => $person) {
            // Veriy is not save in database
            $personCreated = Person::find($person["id"]);
        

            // Valida if not found the person in database to include
            if(false === $personCreated instanceOf Person) {
                $personNew = new Person();

                //$personNew["first_name"] = $person["firstName"];
                //$personNew["sur_name"] = $person["surname"];
                //$personNew["age"] = $person["age"];
                //$personNew["gender"] = $person["gender"];
                //$personCreated = Person::create($personNew);

                $personNew->first_name = $person["firstName"];
                $personNew->sur_name = $person["surname"];
                $personNew->age = $person["age"];
                $personNew->gender = $person["gender"];
                $personNew->save();

                $personCreated = $personNew;
            }

            // Validate exist connections to include
            if(count($person["connections"]) > 0 && !is_null($personCreated->id)) {
                //$this->saveConnections($person["connections"], $personCreated->id);
            }

            // Validate exist cities to include
            if(count($person["cities"]) > 0 && !is_null($personCreated->id)) {
                //$this->saveCities($person["cities"], $personCreated->id);   
            }

        }
        dump("End Load Data");
        
        dump("FIM");
    }

    public function saveConnections($connections, $personId)
    {
        foreach ($connections as $connection) {
            $connectionNew["person_id"] = $personId;
            $connectionNew["connection_id"] = $connection;
            Connection::create();
        }
    }

    public function saveCities($cities, $personId)
    {
        foreach ($cities as $key => $city) {
            $cityNew["person_id"] = $personId;
            $cityNew["name"] = $key;
            $cityNew["value"] = $city;
            City::create();
        }
    }

    public function returnData()
    {
        return array(
           array(
            'id' => 1,
            'firstName' => 'Paul',
            'surname' => 'Crowe',
            'age' => 28,
            'gender' => 'male',
            'connections' => array(2),
            'cities' => array('Dublin' => 80, 'New York' => 100, 'Paris' => 95, 'Madrid' => 100, 'London' => 80, 'Barcelona' => 100, 'Moscow' => 20)
          ),
           array(
            'id' => 2,
            'firstName' => 'Rob',
            'surname' => 'Fitz',
            'age' => 23,
            'gender' => 'male',
            'connections' => array(1, 3),
            'cities' => array('Dublin' => 40, 'New York' => 100, 'Paris' => 65, 'Madrid' => 90)
          ),
           array(
            'id' => 3,
            'firstName' => 'Ben',
            'surname' => "O'Carolan",
            'age' => null,
            'gender' => 'male',
            'connections' => array(2, 4, 5, 7),
            'cities' => array('Paris' => 90, 'Madrid' => 40, 'London' => 85, 'Barcelona' => 90, 'Moscow' => 80)
          ),
           array(
            'id' => 4,
            'firstName' => 'Victor',
            'surname' => '',
            'age' => 28,
            'gender' => 'male',
            'connections' => array(3),
            'cities' => array('Paris' => 80, 'Madrid' => 80, 'London' => 80, 'Barcelona' => 80, 'Moscow' => 40)
          ),
           array(
            'id' => 5,
            'firstName' => 'Peter',
            'surname' => 'Mac',
            'age' => 29,
            'gender' => 'male',
            'connections' => array(3, 6, 11, 10, 7),
            'cities' => array('Dublin' => 60, 'New York' => 100, 'Paris' => 75)
          ),
           array(
            'id' => 6,
            'firstName' => 'John',
            'surname' => 'Barry',
            'age' => 18,
            'gender' => 'male',
            'connections' => array(5),
            'cities' => array('London' => 80)
          ),
           array(
            'id' => 7,
            'firstName' => 'Sarah',
            'surname' => 'Lane',
            'age' => 30,
            'gender' => 'female',
            'connections' => array(3, 5, 20, 12, 8),
            'cities' => array('New York' => 100, 'Chicago' => 70)
          ),
           array(
            'id' => 8,
            'firstName' => 'Susan',
            'surname' => 'Downe',
            'age' => 28,
            'gender' => 'female',
            'connections' => array(7),
            'cities' => array('Chicago' => 70, 'Dublin' => 80)
          ),
           array(
            'id' => 9,
            'firstName' => 'Jack',
            'surname' => 'Stam',
            'age' => 28,
            'gender' => 'male',
            'connections' => array(12),
            'cities' => array('Chicago' => 70)
          ),
           array(
            'id' => 10,
            'firstName' => 'Amy',
            'surname' => 'Lane',
            'age' => 24,
            'gender' => 'female',
            'connections' => array(5, 11),
            'cities' => array('Paris' => 95, 'Barcelona' => 80, 'Moscow' => 100)
          ),
           array(
            'id' => 11,
            'firstName' => 'Sandra',
            'surname' => 'Phelan',
            'age' => 28,
            'gender' => 'female',
            'connections' => array(5, 10, 19, 20),
            'cities' => array('Dublin' => 75, 'Chicago' => 60, 'Moscow' => 70)
          ),
           array(
            'id' => 12,
            'firstName' => 'Laura',
            'surname' => 'Murphy',
            'age' => 33,
            'gender' => 'female',
            'connections' => array(7, 9, 13, 20),
            'cities' => array('Dublin' => 75, 'Moscow' => 75)
          ),
           array(
            'id' => 13,
            'firstName' => 'Lisa',
            'surname' => 'Daly',
            'age' => 28,
            'gender' => 'female',
            'connections' => array(12, 14, 20),
            'cities' => array('Dublin' => 80)
          ),
           array(
            'id' => 14,
            'firstName' => 'Mark',
            'surname' => 'Johnson',
            'age' => 28,
            'gender' => 'male',
            'connections' => array(13, 15),
            'cities' => array('Dublin' => 80, 'New York' => 90, 'Moscow' => 50)
          ),
           array(
            'id' => 15,
            'firstName' => 'Seamus',
            'surname' => 'Crowe',
            'age' => 24,
            'gender' => 'male',
            'connections' => array(14),
            'cities' => array()
          ),
           array(
            'id' => 16,
            'firstName' => 'Daren',
            'surname' => 'Slater',
            'age' => 28,
            'gender' => 'male',
            'connections' => array(18, 20),
            'cities' => array('Paris' => 95, 'Chicago' => 80, 'Moscow' => 20)
          ),
           array(
            'id' => 17,
            'firstName' => 'Dara',
            'surname' => 'Zoltan',
            'age' => 48,
            'gender' => 'male',
            'connections' => array(18, 20),
            'cities' => array('Moscow' => 30)
          ),
           array(
            'id' => 18,
            'firstName' => 'Marie',
            'surname' => 'D',
            'age' => 28,
            'gender' => 'female',
            'connections' => array(17),
            'cities' => array('Chicago' => 30)
          ),
           array(
            'id' => 19,
            'firstName' => 'Catriona',
            'surname' => 'Long',
            'age' => 28,
            'gender' => 'female',
            'connections' => array(11, 20),
            'cities' => array('Chicago' => 40)
          ),
           array(
            'id' => 20,
            'firstName' => 'Katy',
            'surname' => 'Couch',
            'age' => 28,
            'gender' => 'female',
            'connections' => array(7, 11, 12, 13, 16, 17, 19),
            'cities' => array('Dublin' => 90, 'London' => 90)
          )
        );

    }
}
