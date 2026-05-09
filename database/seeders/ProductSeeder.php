<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $data = array (
  0 => 
  array (
    'name' => 'Clothes',
    'subcategories' => 
    array (
      0 => 
      array (
        'name' => 'T-shirt',
        'products' => 
        array (
          0 => 
          array (
            'name' => 'Basic T-Shirt',
            'gender' => 'men',
            'sport' => NULL,
            'description' => 'Comfortable cotton t-shirt for everyday wear',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'white',
                'size' => 'S',
                'price' => 15.0,
                'stock' => 10,
                'is_active' => true,
              ),
              1 => 
              array (
                'color' => 'white',
                'size' => 'M',
                'price' => 15.0,
                'stock' => 10,
                'is_active' => true,
              ),
              2 => 
              array (
                'color' => 'white',
                'size' => 'L',
                'price' => 15.0,
                'stock' => 10,
                'is_active' => true,
              ),
              3 => 
              array (
                'color' => 'white',
                'size' => 'XL',
                'price' => 15.0,
                'stock' => 10,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/shirts/basic-white-shirt-front.png',
                'color' => 'white',
                'sort_order' => 1,
                'is_main' => true,
              ),
              1 => 
              array (
                'image_path' => 'images/shirts/basic-white-shirt-side.png',
                'color' => 'white',
                'sort_order' => 2,
                'is_main' => false,
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'Oversized T-Shirt',
            'gender' => 'men',
            'sport' => NULL,
            'description' => 'Loose fit oversized streetwear t-shirt',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'black',
                'size' => 'S',
                'price' => 22.0,
                'stock' => 3,
                'is_active' => true,
              ),
              1 => 
              array (
                'color' => 'black',
                'size' => 'M',
                'price' => 22.0,
                'stock' => 10,
                'is_active' => true,
              ),
              2 => 
              array (
                'color' => 'black',
                'size' => 'L',
                'price' => 22.0,
                'stock' => 6,
                'is_active' => true,
              ),
              3 => 
              array (
                'color' => 'black',
                'size' => 'XL',
                'price' => 22.0,
                'stock' => 10,
                'is_active' => true,
              ),
              4 => 
              array (
                'color' => 'red',
                'size' => 'S',
                'price' => 22.0,
                'stock' => 10,
                'is_active' => true,
              ),
              5 => 
              array (
                'color' => 'red',
                'size' => 'M',
                'price' => 22.0,
                'stock' => 10,
                'is_active' => true,
              ),
              6 => 
              array (
                'color' => 'red',
                'size' => 'L',
                'price' => 22.0,
                'stock' => 10,
                'is_active' => true,
              ),
              7 => 
              array (
                'color' => 'red',
                'size' => 'XL',
                'price' => 22.0,
                'stock' => 10,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/shirts/oversized-black-shirt-front.png',
                'color' => 'black',
                'sort_order' => 1,
                'is_main' => true,
              ),
              1 => 
              array (
                'image_path' => 'images/shirts/oversized-red-shirt-front.png',
                'color' => 'red',
                'sort_order' => 1,
                'is_main' => true,
              ),
              2 => 
              array (
                'image_path' => 'images/shirts/oversized-black-shirt-back.png',
                'color' => 'black',
                'sort_order' => 2,
                'is_main' => false,
              ),
              3 => 
              array (
                'image_path' => 'images/shirts/oversized-red-shirt-back.png',
                'color' => 'red',
                'sort_order' => 2,
                'is_main' => false,
              ),
              4 => 
              array (
                'image_path' => 'images/shirts/oversized-red-shirt-both.png',
                'color' => 'red',
                'sort_order' => 3,
                'is_main' => false,
              ),
            ),
          ),
          2 => 
          array (
            'name' => 'Women Slim Fit T-Shirt',
            'gender' => 'women',
            'sport' => NULL,
            'description' => 'Slim fit t-shirt designed for comfort and style',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'black',
                'size' => 'S',
                'price' => 18.0,
                'stock' => 7,
                'is_active' => true,
              ),
              1 => 
              array (
                'color' => 'black',
                'size' => 'M',
                'price' => 18.0,
                'stock' => 10,
                'is_active' => true,
              ),
              2 => 
              array (
                'color' => 'black',
                'size' => 'L',
                'price' => 18.0,
                'stock' => 10,
                'is_active' => true,
              ),
              3 => 
              array (
                'color' => 'black',
                'size' => 'XL',
                'price' => 18.0,
                'stock' => 10,
                'is_active' => true,
              ),
              4 => 
              array (
                'color' => 'green',
                'size' => 'S',
                'price' => 18.0,
                'stock' => 10,
                'is_active' => true,
              ),
              5 => 
              array (
                'color' => 'green',
                'size' => 'M',
                'price' => 18.0,
                'stock' => 10,
                'is_active' => true,
              ),
              6 => 
              array (
                'color' => 'green',
                'size' => 'L',
                'price' => 18.0,
                'stock' => 10,
                'is_active' => true,
              ),
              7 => 
              array (
                'color' => 'green',
                'size' => 'XL',
                'price' => 18.0,
                'stock' => 10,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/shirts/women-shirt-black.png',
                'color' => 'black',
                'sort_order' => 1,
                'is_main' => true,
              ),
              1 => 
              array (
                'image_path' => 'images/shirts/women-shirt-green.png',
                'color' => 'green',
                'sort_order' => 1,
                'is_main' => true,
              ),
            ),
          ),
          3 => 
          array (
            'name' => 'Dres',
            'gender' => 'women',
            'sport' => 'basketball',
            'description' => 'basketbalový dres',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'brown',
                'size' => 'XS',
                'price' => 10.0,
                'stock' => 10,
                'is_active' => true,
              ),
              1 => 
              array (
                'color' => 'brown',
                'size' => 'S',
                'price' => 10.0,
                'stock' => 10,
                'is_active' => true,
              ),
              2 => 
              array (
                'color' => 'brown',
                'size' => 'M',
                'price' => 10.0,
                'stock' => 10,
                'is_active' => true,
              ),
              3 => 
              array (
                'color' => 'brown',
                'size' => 'L',
                'price' => 10.0,
                'stock' => 10,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff9a78f0d039.82276612.png',
                'color' => 'brown',
                'sort_order' => 0,
                'is_main' => true,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff9a78f39816.47030913.png',
                'color' => 'brown',
                'sort_order' => 1,
                'is_main' => false,
              ),
            ),
          ),
        ),
      ),
      1 => 
      array (
        'name' => 'Pants',
        'products' => 
        array (
          0 => 
          array (
            'name' => 'zvonceky z roku 90',
            'gender' => 'women',
            'sport' => NULL,
            'description' => 'back to the future alebo ako na kedysi obliekalo',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'brown',
                'size' => 'XS',
                'price' => 30.0,
                'stock' => 10,
                'is_active' => true,
              ),
              1 => 
              array (
                'color' => 'brown',
                'size' => 'S',
                'price' => 30.0,
                'stock' => 10,
                'is_active' => true,
              ),
              2 => 
              array (
                'color' => 'brown',
                'size' => 'M',
                'price' => 30.0,
                'stock' => 10,
                'is_active' => true,
              ),
              3 => 
              array (
                'color' => 'brown',
                'size' => 'L',
                'price' => 30.0,
                'stock' => 10,
                'is_active' => true,
              ),
              4 => 
              array (
                'color' => 'brown',
                'size' => 'XL',
                'price' => 30.0,
                'stock' => 10,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff7edbf24135.50660907.png',
                'color' => 'brown',
                'sort_order' => 0,
                'is_main' => false,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff7edc068692.14751537.png',
                'color' => 'brown',
                'sort_order' => 1,
                'is_main' => true,
              ),
            ),
          ),
        ),
      ),
      2 => 
      array (
        'name' => 'Hoodies',
        'products' => 
        array (
          0 => 
          array (
            'name' => 'tribal mikina',
            'gender' => 'men',
            'sport' => NULL,
            'description' => 'pekna mikinka',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'black',
                'size' => 'M',
                'price' => 40.0,
                'stock' => 20,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff79451df892.05846986.png',
                'color' => 'black',
                'sort_order' => 0,
                'is_main' => true,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff7945218504.13975665.png',
                'color' => 'black',
                'sort_order' => 1,
                'is_main' => false,
              ),
            ),
          ),
        ),
      ),
      3 => 
      array (
        'name' => 'Underwear',
        'products' => 
        array (
          0 => 
          array (
            'name' => 'Trencle',
            'gender' => 'men',
            'sport' => NULL,
            'description' => 'Nech ti nie je vidiet vsetko',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'yellow',
                'size' => 'S',
                'price' => 5.0,
                'stock' => 40,
                'is_active' => true,
              ),
              1 => 
              array (
                'color' => 'yellow',
                'size' => 'M',
                'price' => 5.0,
                'stock' => 40,
                'is_active' => true,
              ),
              2 => 
              array (
                'color' => 'yellow',
                'size' => 'L',
                'price' => 5.0,
                'stock' => 40,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff7e67818df2.95084363.png',
                'color' => 'yellow',
                'sort_order' => 0,
                'is_main' => false,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff7e67855949.02613908.png',
                'color' => 'yellow',
                'sort_order' => 1,
                'is_main' => true,
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'tangá',
            'gender' => 'women',
            'sport' => NULL,
            'description' => 'trošku erotiky nikdy nezaškodí, nie to ešte na školskom projekte',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'green',
                'size' => 'XS',
                'price' => 15.0,
                'stock' => 40,
                'is_active' => true,
              ),
              1 => 
              array (
                'color' => 'green',
                'size' => 'S',
                'price' => 15.0,
                'stock' => 40,
                'is_active' => true,
              ),
              2 => 
              array (
                'color' => 'green',
                'size' => 'M',
                'price' => 15.0,
                'stock' => 40,
                'is_active' => true,
              ),
              3 => 
              array (
                'color' => 'green',
                'size' => 'L',
                'price' => 15.0,
                'stock' => 40,
                'is_active' => true,
              ),
              4 => 
              array (
                'color' => 'green',
                'size' => 'XL',
                'price' => 15.0,
                'stock' => 40,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff8093d50f59.84270924.png',
                'color' => 'green',
                'sort_order' => 0,
                'is_main' => false,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff8093d9c779.39066818.png',
                'color' => 'green',
                'sort_order' => 1,
                'is_main' => true,
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  1 => 
  array (
    'name' => 'Shoes',
    'subcategories' => 
    array (
      0 => 
      array (
        'name' => 'Running shoes',
        'products' => 
        array (
        ),
      ),
      1 => 
      array (
        'name' => 'Sport shoes',
        'products' => 
        array (
          0 => 
          array (
            'name' => 'kopačky od tvojej bývalej',
            'gender' => 'men',
            'sport' => 'football',
            'description' => 'nie sú pekné ale čo už s nimi',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'brown',
                'size' => '40',
                'price' => 40.0,
                'stock' => 10,
                'is_active' => true,
              ),
              1 => 
              array (
                'color' => 'brown',
                'size' => '41',
                'price' => 40.0,
                'stock' => 10,
                'is_active' => true,
              ),
              2 => 
              array (
                'color' => 'brown',
                'size' => '42',
                'price' => 40.0,
                'stock' => 10,
                'is_active' => true,
              ),
              3 => 
              array (
                'color' => 'brown',
                'size' => '43',
                'price' => 40.0,
                'stock' => 10,
                'is_active' => true,
              ),
              4 => 
              array (
                'color' => 'brown',
                'size' => '44',
                'price' => 40.0,
                'stock' => 10,
                'is_active' => true,
              ),
              5 => 
              array (
                'color' => 'brown',
                'size' => '45',
                'price' => 40.0,
                'stock' => 10,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff84ccba80b7.97323875.png',
                'color' => 'brown',
                'sort_order' => 0,
                'is_main' => false,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff84ccc2e465.09405285.png',
                'color' => 'brown',
                'sort_order' => 1,
                'is_main' => true,
              ),
            ),
          ),
        ),
      ),
      2 => 
      array (
        'name' => 'Climbing shoes',
        'products' => 
        array (
        ),
      ),
      3 => 
      array (
        'name' => 'Open shoes',
        'products' => 
        array (
          0 => 
          array (
            'name' => 'šlapky',
            'gender' => 'women',
            'sport' => NULL,
            'description' => 'šlapky na leto',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'brown',
                'size' => '36',
                'price' => 20.0,
                'stock' => 10,
                'is_active' => true,
              ),
              1 => 
              array (
                'color' => 'brown',
                'size' => '37',
                'price' => 20.0,
                'stock' => 10,
                'is_active' => true,
              ),
              2 => 
              array (
                'color' => 'brown',
                'size' => '38',
                'price' => 20.0,
                'stock' => 10,
                'is_active' => true,
              ),
              3 => 
              array (
                'color' => 'brown',
                'size' => '39',
                'price' => 20.0,
                'stock' => 10,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff85d33f9cc2.80000826.png',
                'color' => 'brown',
                'sort_order' => 0,
                'is_main' => true,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff85d343ad99.01425345.png',
                'color' => 'brown',
                'sort_order' => 1,
                'is_main' => false,
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  2 => 
  array (
    'name' => 'Accessories',
    'subcategories' => 
    array (
      0 => 
      array (
        'name' => 'Caps & hats',
        'products' => 
        array (
          0 => 
          array (
            'name' => 'čapička',
            'gender' => 'women',
            'sport' => NULL,
            'description' => 'pekná čapička, nič nepokazíš',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'pink',
                'size' => 'one-size',
                'price' => 15.0,
                'stock' => 20,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff8293729d36.88319057.png',
                'color' => 'pink',
                'sort_order' => 0,
                'is_main' => false,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff829376ac35.97828566.png',
                'color' => 'pink',
                'sort_order' => 1,
                'is_main' => true,
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'šiltovka',
            'gender' => 'women',
            'sport' => NULL,
            'description' => 'ochráni ťa pred slniečkom ale bude ťa bolieť hlava',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'black',
                'size' => 'one-size',
                'price' => 15.0,
                'stock' => 40,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff834d11f188.70431497.png',
                'color' => 'black',
                'sort_order' => 0,
                'is_main' => false,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff834d16af21.50973083.png',
                'color' => 'black',
                'sort_order' => 1,
                'is_main' => true,
              ),
            ),
          ),
        ),
      ),
      1 => 
      array (
        'name' => 'Bags & backpacks',
        'products' => 
        array (
          0 => 
          array (
            'name' => 'fancy kabelka',
            'gender' => 'women',
            'sport' => NULL,
            'description' => 'stylova kabelocka ktoru neodmietnes',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'white',
                'size' => 'one-size',
                'price' => 150.0,
                'stock' => 5,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff7b53174d58.85845324.png',
                'color' => 'white',
                'sort_order' => 0,
                'is_main' => true,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff7b531b2212.93227568.png',
                'color' => 'white',
                'sort_order' => 1,
                'is_main' => false,
              ),
            ),
          ),
        ),
      ),
      2 => 
      array (
        'name' => 'Socks',
        'products' => 
        array (
          0 => 
          array (
            'name' => 'PPPonozky',
            'gender' => 'men',
            'sport' => NULL,
            'description' => 'aby ti deti neutiekli',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'blue',
                'size' => 'one-size',
                'price' => 7.0,
                'stock' => 40,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff7cbab22431.57824480.png',
                'color' => 'blue',
                'sort_order' => 0,
                'is_main' => false,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff7cbab62b44.61794402.png',
                'color' => 'blue',
                'sort_order' => 1,
                'is_main' => true,
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'PPPonozky',
            'gender' => 'women',
            'sport' => NULL,
            'description' => 'ženám je vždy zima, treba hrubšie',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'red',
                'size' => 'one-size',
                'price' => 10.0,
                'stock' => 40,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff8122d69324.18507247.png',
                'color' => 'red',
                'sort_order' => 0,
                'is_main' => false,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff8122dc15f2.96048950.png',
                'color' => 'red',
                'sort_order' => 1,
                'is_main' => true,
              ),
            ),
          ),
        ),
      ),
      3 => 
      array (
        'name' => 'Watches',
        'products' => 
        array (
          0 => 
          array (
            'name' => 'elegantne hodinky',
            'gender' => 'women',
            'sport' => NULL,
            'description' => 'už keď ich vidíš, tak ich chceš vlastniť',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'white',
                'size' => 'one-size',
                'price' => 70.0,
                'stock' => 20,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff8254986213.17277078.png',
                'color' => 'white',
                'sort_order' => 0,
                'is_main' => true,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff82549c79c2.75053311.png',
                'color' => 'white',
                'sort_order' => 1,
                'is_main' => false,
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'hodinky',
            'gender' => 'women',
            'sport' => NULL,
            'description' => 'elegantné hodinky, ktoré ti budú závidieť aj babičky na lavičkách',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'red',
                'size' => 'one-size',
                'price' => 80.0,
                'stock' => 20,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff838c34ed71.37970207.png',
                'color' => 'red',
                'sort_order' => 0,
                'is_main' => true,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff838c39cc80.88111583.png',
                'color' => 'red',
                'sort_order' => 1,
                'is_main' => false,
              ),
            ),
          ),
        ),
      ),
      4 => 
      array (
        'name' => 'Sunglasses',
        'products' => 
        array (
          0 => 
          array (
            'name' => 'okulaaris',
            'gender' => 'men',
            'sport' => NULL,
            'description' => 'nic extra nic slabe, iba take puklice na tvar',
            'variants' => 
            array (
              0 => 
              array (
                'color' => 'black',
                'size' => 'one-size',
                'price' => 66.0,
                'stock' => 10,
                'is_active' => true,
              ),
            ),
            'images' => 
            array (
              0 => 
              array (
                'image_path' => 'images/products/product_69ff7b95d6d3e0.10657975.png',
                'color' => 'black',
                'sort_order' => 0,
                'is_main' => false,
              ),
              1 => 
              array (
                'image_path' => 'images/products/product_69ff7b95da6936.70272184.png',
                'color' => 'black',
                'sort_order' => 1,
                'is_main' => true,
              ),
            ),
          ),
        ),
      ),
      5 => 
      array (
        'name' => 'Gloves',
        'products' => 
        array (
        ),
      ),
      6 => 
      array (
        'name' => 'Water bottles',
        'products' => 
        array (
        ),
      ),
    ),
  ),
);

        DB::transaction(function () use ($data) {
            foreach ($data as $categoryData) {
                $categoryId = DB::table('categories')->insertGetId([
                    'name' => $categoryData['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($categoryData['subcategories'] as $subcategoryData) {
                    $subcategoryId = DB::table('subcategories')->insertGetId([
                        'name' => $subcategoryData['name'],
                        'category_id' => $categoryId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    foreach ($subcategoryData['products'] as $productData) {
                        $productId = DB::table('products')->insertGetId([
                            'name' => $productData['name'],
                            'subcategory_id' => $subcategoryId,
                            'gender' => $productData['gender'],
                            'sport' => $productData['sport'],
                            'description' => $productData['description'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        foreach ($productData['variants'] as $variantData) {
                            DB::table('product_variants')->insert([
                                'product_id' => $productId,
                                'color' => $variantData['color'],
                                'size' => $variantData['size'],
                                'price' => $variantData['price'],
                                'stock' => $variantData['stock'],
                                'is_active' => $variantData['is_active'],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }

                        foreach ($productData['images'] as $imageData) {
                            DB::table('product_images')->insert([
                                'product_id' => $productId,
                                'image_path' => $imageData['image_path'],
                                'color' => $imageData['color'],
                                'sort_order' => $imageData['sort_order'],
                                'is_main' => $imageData['is_main'],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
        });
    }
}