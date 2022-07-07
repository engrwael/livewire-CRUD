<?php

namespace Database\Seeders;

use App\Models\Continent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContinentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Continent::create([
            'continent_name' => 'Africa'
        ]);

        Continent::create([
            'continent_name' => 'Europe'
        ]);

        Continent::create([
            'continent_name' => 'Asia'
        ]);

        Continent::create([
            'continent_name' => 'North America'
        ]);

        Continent::create([
            'continent_name' => 'South America'
        ]);

        Continent::create([
            'continent_name' => 'Australia'
        ]);

        Continent::create([
            'continent_name' => 'Antarctica'
        ]);
    }
}