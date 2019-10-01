<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Supplier;
class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Supplier::truncate();

        foreach(range(1,50) as $i){
            Supplier::create([
                'company' => $faker->company,
                'email' => $faker->email,
                'name' => $faker->name,
                'phone' => $faker->numberBetween(10000,50000),
                'address' => $faker->address
            ]);
        }


    }
}
