<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');



#HOMEPAGE
Route::get('/', function () {
    $products = DB::table('product_variants')
        ->join('products', 'products.id', '=', 'product_variants.product_id')
        ->leftJoin('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.product_id')
                ->on('product_variants.color', '=', 'product_images.color')
                ->where('product_images.is_main', true);
        })
        ->select(
            DB::raw('MIN(product_variants.id) as variant_id'),
            'products.name',
            'product_variants.color',
            DB::raw('MIN(product_variants.price) as price'),
            'product_images.image_path'
        )
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

#PRODUCT PAGE
Route::get('/product/{variantId}', function ($variantId) {
    $variant = DB::table('product_variants')
        ->where('id', $variantId)
        ->first();

    abort_if(!$variant, 404);

    $product = DB::table('products')
        ->where('id', $variant->product_id)
        ->first();

    $images = DB::table('product_images')
        ->where('product_id', $product->id)
        ->where('color', $variant->color)
        ->orderBy('sort_order')
        ->get();

    $sizes = DB::table('product_variants')
        ->where('product_id', $product->id)
        ->where('color', $variant->color)
        ->get();

    return view('productpage', compact('product', 'variant', 'images', 'sizes'));
})->name('productpage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
