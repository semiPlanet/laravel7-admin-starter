<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $units = ['stripe', 'bottle', 'tablets', 'dozens'];
     
        for($i=0;$i<900;$i++){

            $name = $faker->name;

            $user = Product::create([
                "name" => $name,
                "code" => substr($name, 0, 2),
                "chemicals" => array('pracetamol','butanol','methanol', 'terbutalin','acids'),
                "size"  => array('500mg', '200ml', '1000mg'),
                "price" => rand(50, 250),
                "unit"  => $units[rand(0, 3)]
            ]);

        }
    }
}
