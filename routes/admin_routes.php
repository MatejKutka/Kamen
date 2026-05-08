<?php
// ============================================================
// TOTO PRIDAJ DO web.php (na začiatok, k ostatným use importom)
// ============================================================
use App\Http\Controllers\Admin\AdminProductController;

// ============================================================
// TOTO PRIDAJ DO web.php (pred require __DIR__.'/auth.php')
// ============================================================

// Admin login redirect – keď sa admin prihlási, presmeruj ho na /admin
// Pridaj do RouteServiceProvider alebo do LoginController redirectTo:
// public function redirectTo() { return auth()->user()->role === 'admin' ? '/admin' : '/dashboard'; }

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', function () {
        $stats = [
            'products' => DB::table('products')->count(),
            'orders'   => DB::table('orders')->count(),
            'users'    => DB::table('users')->where('role', 'customer')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    })->name('dashboard');

    // Produkty CRUD
    Route::get('/products',              [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create',       [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products',             [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit',    [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}',         [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}',      [AdminProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/variants/{id}',      [AdminProductController::class, 'destroyVariant'])->name('variants.destroy');
});