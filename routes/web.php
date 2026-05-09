<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\OrderController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

/*
|--------------------------------------------------------------------------
| HOMEPAGE
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $products = DB::table('product_variants')
        ->join('products', 'products.id', '=', 'product_variants.product_id')
        ->leftJoin('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.product_id')
                ->whereRaw('LOWER(TRIM(product_variants.color)) = LOWER(TRIM(product_images.color))')
                ->where('product_images.is_main', true);
        })
        ->select(
            DB::raw('MIN(product_variants.id) as variant_id'),
            'products.name',
            'product_variants.color',
            DB::raw('MIN(product_variants.price) as price'),
            'product_images.image_path'
        )
        ->where('product_variants.is_active', true)
        ->groupBy(
            'products.id',
            'products.name',
            'product_variants.color',
            'product_images.image_path'
        )
        ->take(3)
        ->get();

    return view('homepage', compact('products'));
})->name('home');

/*
|--------------------------------------------------------------------------
| PRODUCT PAGE
|--------------------------------------------------------------------------
*/
Route::get('/product/{variantId}', function ($variantId) {
    $variant = DB::table('product_variants')
        ->where('id', $variantId)
        ->where('is_active', true)
        ->first();

    abort_if(!$variant, 404);

    $product = DB::table('products')
        ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
        ->join('categories', 'categories.id', '=', 'subcategories.category_id')
        ->where('products.id', $variant->product_id)
        ->select(
            'products.*',
            'categories.name as category_name',
            'subcategories.name as subcategory_name'
        )
        ->first();

    abort_if(!$product, 404);

    $images = DB::table('product_images')
        ->where('product_id', $product->id)
        ->whereRaw('LOWER(TRIM(color)) = LOWER(TRIM(?))', [$variant->color])
        ->orderBy('sort_order')
        ->get();

    $sizes = DB::table('product_variants')
        ->where('product_id', $product->id)
        ->whereRaw('LOWER(TRIM(color)) = LOWER(TRIM(?))', [$variant->color])
        ->where('is_active', true)
        ->orderBy('size')
        ->get();

    $relatedProducts = DB::table('product_variants')
        ->join('products', 'products.id', '=', 'product_variants.product_id')
        ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
        ->join('categories', 'categories.id', '=', 'subcategories.category_id')
        ->leftJoin('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.product_id')
                ->whereRaw('LOWER(TRIM(product_variants.color)) = LOWER(TRIM(product_images.color))')
                ->where('product_images.is_main', true);
        })
        ->where('product_variants.is_active', true)
        ->where('products.id', '!=', $product->id)
        ->where(function ($query) use ($product) {
            $query->where('products.subcategory_id', $product->subcategory_id)
                ->orWhere('products.gender', $product->gender);

            if (!empty($product->sport)) {
                $query->orWhereRaw('LOWER(TRIM(products.sport)) = ?', [
                    mb_strtolower(trim($product->sport), 'UTF-8')
                ]);
            }
        })
        ->select(
            DB::raw('MIN(product_variants.id) as variant_id'),
            'products.id as product_id',
            'products.name',
            'products.gender',
            'products.subcategory_id',
            'products.sport',
            'product_variants.color',
            DB::raw('MIN(product_variants.price) as price'),
            'product_images.image_path'
        )
        ->groupBy(
            'products.id',
            'products.name',
            'products.gender',
            'products.subcategory_id',
            'products.sport',
            'product_variants.color',
            'product_images.image_path'
        )
        ->orderByRaw("
            CASE
                WHEN products.subcategory_id = ? THEN 1
                WHEN LOWER(TRIM(COALESCE(products.sport, ''))) = ? THEN 2
                WHEN products.gender = ? THEN 3
                ELSE 4
            END
        ", [
            $product->subcategory_id,
            mb_strtolower(trim($product->sport ?? ''), 'UTF-8'),
            $product->gender,
        ])
        ->limit(5)
        ->get();

    return view('productpage', compact(
        'product',
        'variant',
        'images',
        'sizes',
        'relatedProducts'
    ));
})->name('productpage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        $stats = [
            'products' => DB::table('products')->count(),
            'orders'   => DB::table('orders')->count(),
            'users'    => DB::table('users')->where('role', 'customer')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    })->name('dashboard');

    Route::get('/products',           [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create',    [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products',          [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}',      [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}',   [AdminProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/variants/{id}',   [AdminProductController::class, 'destroyVariant'])->name('variants.destroy');
});

Route::get('/checkout', [OrderController::class, 'showDelivery'])->name('checkout.delivery');
Route::post('/checkout', [OrderController::class, 'storeDelivery'])->name('checkout.delivery.store');
Route::get('/checkout/payment', [OrderController::class, 'showPayment'])->name('checkout.payment');
Route::post('/checkout/order', [OrderController::class, 'placeOrder'])->name('checkout.order');
Route::get('/order/confirmation/{orderId}', [OrderController::class, 'confirmation'])->name('checkout.confirmation');

require __DIR__.'/auth.php';