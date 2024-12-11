<?php

namespace App\Console\Commands;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;

class ResetDailyQuantity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:daily-quantity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Làm mới số lượng hàng ngày của sản phẩm';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $categories = Category::where('is_resettable', 1)->get();

        foreach ($categories as $category) {
            $products = Product::where('category_id', $category->id)->get();

            foreach ($products as $product) {
                // Kiểm tra xem sản phẩm có thuộc tính không
                if ($product->attributes->count() > 0) {
                    foreach ($product->attributes as $attribute) {
                        $attributeValue = AttributeValue::where('attribute_id', $attribute->id)->first();
                        $attributeValue->update(['quantity' => $attributeValue->daily_quantity]);
                    }
                } else { 
                    $product->update(['quantity' => $product->daily_quantity]);
                }
            }
        }
    }
}
