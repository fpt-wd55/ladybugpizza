<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataProduct = [
            'banh-ngot' => [
                'Blueberry cheesecake',
                'Tiramisu',
                'Croissant pur beurre',
                'Pain au Chocolat',
                'Pain Suisse',
                'Almond Croissant',
                'Pizza Nutella',
                'Chocolate Tar',
            ],
            'salad' => [
                'Bufala Caprese Salad',
                'Goat cheese Salad',
                'Beetroot Salad',
                'Burrata Salad',
                'Garlic bread platter',
            ],
            'pizza' => [
                'Pizza Pesto Napoli',
                'Pizza Vegetariana',
                'Pizza Carbonara',
                'Pizza Raffaello',
                'Pizza Pesto Burrata',
                'Pizza Margherita',
                'Pizza Spicy Burrata',
                'Pizza Chèvre Chaud',
                'Pizza Eggplant',
                'Pizza Calzone',
                'Pizza 4 Formaggi',
                'Pizza Tartufo',
                'Pizza Emilio',
                'Pizza Pancetta',
                'Pizza Alice',
                'Pizza Capricciosa',
                'Pizza Rucola Parma',
                'Pizza Napoletana',
                'Pizza Margherita DOP',
                'Pizza Française',
                'Pizza Tartufissimo',
                'Pizza Marinara',
                'Pizza 5 Formaggi',
                'Pizza Sicilian',
                'Pizza Hot Honey',
            ],
            'my' => [
                'Mỳ Ý Pesto',
                'Mỳ Ý Cay Hải Sản',
                'Mỳ Ý Bò Bằm',
                'Mỳ Ý Gà Cay',
                'Mỳ Ý Tôm Sốt Kem',
                'Mỳ Ý Dăm Bông',
            ],
            'nuoc-ngot' => [
                'Coca Classic',
                'Coca Zero',
                'Coca Light',
                'Pepsi',
                'Fanta',
                'Soda Schweppes',
                'Mountain Dew',
            ],
            'ga' => [
                'Cánh gà nướng',
                'Gà không xương sốt cay',
                'Gà không xương mắm tỏi',
                'Cánh gà sốt cay',
                'Gà phủ phô mai',
                'Đùi gà chiên giòn',
                'Gà nướng mật ong',
            ],
            'combo' => [
                'Combo 1',
                'Combo 2',
                'Combo 3',
                'Combo 4',
                'Combo 5',
                'Combo 6',
                'Combo 7',
                'Combo 8',
                'Combo 9',
                'Combo 10',
            ]
        ];

        // Create Product
        $categories = DB::table('categories')->get();

        // for

        // php artisan make:seeder ProductSeeder
        // php artisan make:seeder ProductAttributeSeeder
    }
}
// Schema::create('products', function (Blueprint $table) {
//     $table->string('name');
//     $table->string('slug')->unique();
//     $table->string('image');
//     $table->text('description');
//     $table->foreignId('category_id')->constrained()->cascadeOnDelete();
//     $table->bigInteger('price');
//     $table->bigInteger('discount_price')->nullable();
//     $table->integer('quantity');
//     $table->string('sku')->unique();
//     $table->tinyInteger('status')->default(1)->comment('1: active; 2: inactive');
//     $table->tinyInteger('is_featured')->default(2)->comment('1: yes; 2: no');
//     $table->float('avg_rating')->default(0);
//     $table->integer('total_rating')->default(0);
// });



// Schema::create('product_attributes', function (Blueprint $table) {
//     $table->id();
//     $table->foreignId('product_id')->constrained()->cascadeOnDelete();
//     $table->foreignId('attribute_value_id')->constrained()->cascadeOnDelete();
//     $table->string('price');
//     $table->timestamps();
// });