<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Topping;
use Illuminate\Support\Str;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  
        $toppings = [
            'Phô Mai Sữa Dê',
            'Phô Mai Mozzarella',
            'Phô Mai Cheddar',
            'Phô Mai Scamorza',
            'Phô Mai Ricotta',
            'Phô Mai Burrata',
            'Salami',
            'Xúc xích Pepperoni',
            'Thịt xông khói',
            'Nấm Truffle',
            'Hành tây',
            'Ớt chuông',
            'Quả ô liu',
            'Dứa',
            'Tôm',
            'Rau Cải Arugula',
            'Húng quế'
        ];

        foreach ($toppings as $topping) {
            Topping::create([
                'name' => $topping,
                'slug' => Str::slug($topping),
                'image' => Str::slug($topping) . '.jpeg',
                'price' => rand(10, 50) * 1000,
                'quantity' => rand(10, 50),
                'category_id' => 1, 
            ]);
        }
    }
}
