<?php

use Illuminate\Database\Seeder;

use App\Person;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Person::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Person::create([
                'firtName' => $faker->name,
                'surName' => $faker->lastname,
                'age' => $faker->numberBetween(10, 100),
                'gender' => $faker->randomElements($array = array ('male','female'), $count = 1),
            ]);
        }
    }
}
