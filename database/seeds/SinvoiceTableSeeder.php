<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Sinvoice;
use App\SinvoiceItem;

class SinvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Sinvoice::truncate();
        SinvoiceItem::Truncate();

        $discount = $faker->numberBetween(500, 10000);
        $subtotal = $faker->numberBetween(500000, 1000000);

        foreach(range(1,50) as $i){

           $invoice = Sinvoice::create([
                'supplier_id' => $i,
                'title' => $faker->sentence,
                'date' => '2018-'.mt_rand(1,12).'-'.mt_rand(1,28),
                'due_date' => '2018-'.mt_rand(1,12).'-'.mt_rand(1,28),
                'discount' => $discount,
                'sub_total' => $subtotal,
                'total' => $subtotal - $discount
            ]);

            foreach(range(1, mt_rand(5,10)) as $j){
                SinvoiceItem::create([
                    'sinvoice_id' => $invoice->id,
                    'product_id' => $faker->numberBetween(1, 100),
                    'description' => $faker->sentence,
                    'qty' => $faker->numberBetween(4,5),
                    'unit_price' => $faker->numberBetween(10000,50000)
                ]);
            }
        }


    }
}
