<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $toppings = [
            'Phô mai sữa dê' => [
                'image' => 'topping-pho-mai-sua-de.jpg',
                'price' => 10000,
            ],
            'Mozzarella' => [
                'image' => 'topping-mozzarella.jpg',
                'price' => 10000,
            ],
            'Cheddar' => [
                'image' => 'topping-cheddar.jpg',
                'price' => 10000,
            ],
            'Scamorza' => [
                'image' => 'topping-scamorza.jpg',
                'price' => 10000,
            ],
            'Ricotta' => [
                'image' => 'topping-ricotta.jpg',
                'price' => 10000,
            ],
            'Burrata' => [
                'image' => 'topping-burrata.jpg',
                'price' => 10000,
            ],
            'Salami' => [
                'image' => 'topping-salami.jpg',
                'price' => 10000,
            ],
            'Pepperoni' => [
                'image' => 'topping-pepperoni.jpg',
                'price' => 10000,
            ],
            'Thịt xông khói' => [
                'image' => 'topping-thit-xong-khoi.jpg',
                'price' => 10000,
            ],
            'Hành tây' => [
                'image' => 'topping-hanh-tay.jpg',
                'price' => 10000,
            ],
            'Ớt chuông' => [
                'image' => 'topping-ot-chuong.jpg',
                'price' => 10000,
            ],
            'Quả ô liu' => [
                'image' => 'topping-qua-oliu.jpg',
                'price' => 10000,
            ],
        ];

        foreach ($toppings as $name => $topping) {
            DB::table('toppings')->insert([
                'name' => $name,
                'image' => $topping['image'],
                'price' => $topping['price'],
                'category_id' => 3,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}
