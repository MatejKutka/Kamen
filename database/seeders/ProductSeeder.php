<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // CATEGORY
        $categoryId = DB::table('categories')->insertGetId([
            'name' => 'clothes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // SUBCATEGORY
        $subcategoryId = DB::table('subcategories')->insertGetId([
            'name' => 't-shirt',
            'category_id' => $categoryId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // PRODUCTS
        $products = [
            [
                'name' => 'Basic T-Shirt',
                'gender' => 'men',
                'description' => 'Comfortable cotton t-shirt for everyday wear',
                'price' => 15,
                'colors' => [
                    'white' => [
                        'images/shirts/basic-white-shirt-front.png',
                        'images/shirts/basic-white-shirt-side.png',
                    ],
                ],
            ],
            [
                'name' => 'Oversized T-Shirt',
                'gender' => 'men',
                'description' => 'Loose fit oversized streetwear t-shirt',
                'price' => 22,
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
                'gender' => 'women',
                'description' => 'Slim fit t-shirt designed for comfort and style',
                'price' => 18,
                'colors' => [
                    'black' => [
                        'images/shirts/women-shirt-black.png',
                    ],
                    'green' => [
                        'images/shirts/women-shirt-green.png',
                    ],
                ],
            ],
        ];

        foreach ($products as $product) {
            $productId = DB::table('products')->insertGetId([
                'name' => $product['name'],
                'subcategory_id' => $subcategoryId,
                'gender' => $product['gender'],
                'description' => $product['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($product['colors'] as $color => $images) {
                foreach (['S', 'M', 'L', 'XL'] as $size) {
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