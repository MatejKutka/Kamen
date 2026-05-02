<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // CLOTHES CATEGORY
        $clothesCategoryId = DB::table('categories')->insertGetId([
            'name' => 'Clothes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // T-SHIRT SUBCATEGORY
        $tShirtSubcategoryId = DB::table('subcategories')->insertGetId([
            'name' => 'T-shirt',
            'category_id' => $clothesCategoryId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // SHOES CATEGORY
        $shoesCategoryId = DB::table('categories')->insertGetId([
            'name' => 'Shoes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // RUNNING SHOES SUBCATEGORY
        $runningShoesSubcategoryId = DB::table('subcategories')->insertGetId([
            'name' => 'Running Shoes',
            'category_id' => $shoesCategoryId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // PRODUCTS
        $products = [
            [
                'name' => 'Basic T-Shirt',
                'subcategory_id' => $tShirtSubcategoryId,
                'gender' => 'men',
                'description' => 'Comfortable cotton t-shirt for everyday wear',
                'price' => 15,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => [
                    'white' => [
                        'images/shirts/basic-white-shirt-front.png',
                        'images/shirts/basic-white-shirt-side.png',
                    ],
                ],
            ],
            [
                'name' => 'Oversized T-Shirt',
                'subcategory_id' => $tShirtSubcategoryId,
                'gender' => 'men',
                'description' => 'Loose fit oversized streetwear t-shirt',
                'price' => 22,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => [
                    'black' => [
                        'images/shirts/oversized-black-shirt-front.png',
                        'images/shirts/oversized-black-shirt-back.png',
                    ],
                    'red' => [
                        'images/shirts/oversized-red-shirt-front.png',
                        'images/shirts/oversized-red-shirt-back.png',
                        'images/shirts/oversized-red-shirt-both.png',
                    ],
                ],
            ],
            [
                'name' => 'Women Slim Fit T-Shirt',
                'subcategory_id' => $tShirtSubcategoryId,
                'gender' => 'women',
                'description' => 'Slim fit t-shirt designed for comfort and style',
                'price' => 18,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => [
                    'black' => [
                        'images/shirts/women-shirt-black.png',
                    ],
                    'green' => [
                        'images/shirts/women-shirt-green.png',
                    ],
                ],
            ],
            [
                'name' => 'Women Running Shoes',
                'subcategory_id' => $runningShoesSubcategoryId,
                'gender' => 'women',
                'description' => 'Lightweight breathable women running shoes designed for comfort and daily training',
                'price' => 65,
                'sizes' => ['36', '37', '38', '39', '40', '41'],
                'colors' => [
                    'gray' => [
                        'images/shoes/women-running-gray-pink.png',
                    ],
                ],
            ],
        ];

        foreach ($products as $product) {
            $productId = DB::table('products')->insertGetId([
                'name' => $product['name'],
                'subcategory_id' => $product['subcategory_id'],
                'gender' => $product['gender'],
                'description' => $product['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($product['colors'] as $color => $images) {
                foreach ($product['sizes'] as $size) {
                    DB::table('product_variants')->insert([
                        'product_id' => $productId,
                        'color' => $color,
                        'size' => $size,
                        'price' => $product['price'],
                        'stock' => 10,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                foreach ($images as $index => $imagePath) {
                    DB::table('product_images')->insert([
                        'product_id' => $productId,
                        'image_path' => $imagePath,
                        'color' => $color,
                        'sort_order' => $index + 1,
                        'is_main' => $index === 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}