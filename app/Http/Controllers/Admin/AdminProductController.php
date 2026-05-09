<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminProductController extends Controller
{
    public function index()
    {
        $mainImages = DB::table('product_images')
            ->select('product_id', 'color', DB::raw('MIN(image_path) as image_path'))
            ->where('is_main', true)
            ->groupBy('product_id', 'color');

        $products = DB::table('products')
            ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->join('product_variants', 'product_variants.product_id', '=', 'products.id')
           ->leftJoinSub($mainImages, 'main_images', function ($join) {
                $join->on('products.id', '=', 'main_images.product_id')
                    ->whereRaw('LOWER(TRIM(product_variants.color)) = LOWER(TRIM(main_images.color))');
            })
            ->select(
                'products.id',
                'products.name',
                'products.gender',
                'products.sport',
                'categories.name as category_name',
                'subcategories.name as subcategory_name',
                'product_variants.color',
                'main_images.image_path',
                'products.created_at'
            )
            ->groupBy(
                'products.id',
                'products.name',
                'products.gender',
                'products.sport',
                'categories.name',
                'subcategories.name',
                'product_variants.color',
                'main_images.image_path',
                'products.created_at'
            )
            ->orderByDesc('products.created_at')
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = DB::table('categories')->get();
        $subcategories = DB::table('subcategories')->get();

        return view('admin.products.create', compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'subcategory_id'   => 'required|exists:subcategories,id',
            'gender'           => 'required|string',
            'sport'            => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'color'            => 'required|string|max:100',

            'variants'         => 'required|array|min:1',
            'variants.*.size'  => 'required|string|max:50',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',

            'images'           => 'nullable|array',
            'images.*'         => 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'main_image_index' => 'nullable|integer',
        ]);

        $productColor = $this->normalizeColor($request->color);

        $productId = DB::table('products')->insertGetId([
            'name'           => $request->name,
            'subcategory_id' => $request->subcategory_id,
            'gender'         => $request->gender,
            'sport'          => $this->normalizeSport($request->sport),
            'description'    => $request->description,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        foreach ($request->variants as $v) {
            DB::table('product_variants')->insert([
                'product_id' => $productId,
                'color'      => $productColor,
                'size'       => $v['size'],
                'price'      => $v['price'],
                'stock'      => $v['stock'],
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($request->hasFile('images')) {
    File::ensureDirectoryExists(public_path('images/products'));

    $mainIndex = (int) $request->input('main_image_index', 0);

    foreach ($request->file('images') as $i => $file) {
        $filename = uniqid('product_', true) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/products'), $filename);

        $path = 'images/products/' . $filename;

        DB::table('product_images')->insert([
            'product_id' => $productId,
            'image_path' => $path,
            'color'      => $productColor,
            'sort_order' => $i,
            'is_main'    => ($i === $mainIndex),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

        $this->exportProductsToSeeder();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produkt bol úspešne pridaný.');
    }

    public function edit(Request $request, $id)
    {
        $color = $this->normalizeColor($request->query('color'));

        $product = DB::table('products')->where('id', $id)->first();
        abort_if(!$product, 404);

        $variants = DB::table('product_variants')
            ->where('product_id', $id)
            ->when($color, function ($query) use ($color) {
                $query->whereRaw('LOWER(TRIM(color)) = ?', [$color]);
            })
            ->get();

        $images = DB::table('product_images')
            ->where('product_id', $id)
            ->when($color, function ($query) use ($color) {
                $query->whereRaw('LOWER(TRIM(color)) = ?', [$color]);
            })
            ->orderBy('sort_order')
            ->get();

        $categories = DB::table('categories')->get();
        $subcategories = DB::table('subcategories')->get();

        return view('admin.products.edit', compact(
            'product',
            'variants',
            'images',
            'categories',
            'subcategories',
            'color'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'subcategory_id' => 'required|exists:subcategories,id',
            'gender'         => 'required|string',
            'sport'          => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'color'          => 'required|string|max:100',
            'old_color'      => 'nullable|string|max:100',
            'new_images'     => 'nullable|array',
            'new_images.*'   => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $oldColor = $this->normalizeColor($request->input('old_color', $request->input('color')));
        $newColor = $this->normalizeColor($request->input('color'));

        DB::table('products')->where('id', $id)->update([
            'name'           => $request->name,
            'subcategory_id' => $request->subcategory_id,
            'gender'         => $request->gender,
            'sport'          => $this->normalizeSport($request->sport),
            'description'    => $request->description,
            'updated_at'     => now(),
        ]);

        if ($request->hasFile('new_images')) {
    File::ensureDirectoryExists(public_path('images/products'));

    $maxOrder = DB::table('product_images')
        ->where('product_id', $id)
        ->whereRaw('LOWER(TRIM(color)) = ?', [$newColor])
        ->max('sort_order') ?? -1;

    $hasMainImage = DB::table('product_images')
        ->where('product_id', $id)
        ->whereRaw('LOWER(TRIM(color)) = ?', [$newColor])
        ->where('is_main', true)
        ->exists();

    foreach ($request->file('new_images') as $i => $file) {
        $filename = uniqid('product_', true) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/products'), $filename);

        $path = 'images/products/' . $filename;

        DB::table('product_images')->insert([
            'product_id' => $id,
            'image_path' => $path,
            'color'      => $newColor,
            'sort_order' => $maxOrder + $i + 1,
            'is_main'    => (!$hasMainImage && $i === 0),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

        if ($request->has('new_variants')) {
            foreach ($request->new_variants as $v) {
                if (!empty($v['size'])) {
                    DB::table('product_variants')->insert([
                        'product_id' => $id,
                        'color'      => $newColor,
                        'size'       => $v['size'],
                        'price'      => $v['price'],
                        'stock'      => $v['stock'],
                        'is_active'  => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        DB::table('product_images')
            ->where('product_id', $id)
            ->when($oldColor, function ($query) use ($oldColor) {
                $query->whereRaw('LOWER(TRIM(color)) = ?', [$oldColor]);
            })
            ->update([
                'color' => $newColor,
                'updated_at' => now(),
            ]);

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imgId) {
                $img = DB::table('product_images')
                    ->where('id', $imgId)
                    ->where('product_id', $id)
                    ->first();

                if ($img) {
                    @unlink(public_path($img->image_path));
                    DB::table('product_images')->where('id', $imgId)->delete();
                }
            }
        }

        if ($request->hasFile('new_images')) {
            $maxOrder = DB::table('product_images')
                ->where('product_id', $id)
                ->whereRaw('LOWER(TRIM(color)) = ?', [$newColor])
                ->max('sort_order') ?? -1;

            foreach ($request->file('new_images') as $i => $file) {
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/products'), $filename);

                $path = 'images/products/' . $filename;

                DB::table('product_images')->insert([
                    'product_id' => $id,
                    'image_path' => $path,
                    'color'      => $newColor,
                    'sort_order' => $maxOrder + $i + 1,
                    'is_main'    => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        if ($request->has('main_image_id')) {
            DB::table('product_images')
                ->where('product_id', $id)
                ->whereRaw('LOWER(TRIM(color)) = ?', [$newColor])
                ->update(['is_main' => false]);

            DB::table('product_images')
                ->where('id', $request->main_image_id)
                ->where('product_id', $id)
                ->update(['is_main' => true]);
        }

        $this->exportProductsToSeeder();

        $redirectUrl = route('admin.products.edit', $id);

        if ($newColor) {
            $redirectUrl .= '?color=' . urlencode($newColor);
        }

        return redirect($redirectUrl)
            ->with('success', 'Produkt bol aktualizovaný.');
    }

    public function destroyVariant($id)
    {
        DB::table('product_variants')->where('id', $id)->delete();

        $this->exportProductsToSeeder();

        return redirect()->back()->with('success', 'Variant bol odstránený.');
    }

    public function destroy($id)
    {
        $images = DB::table('product_images')->where('product_id', $id)->get();

        foreach ($images as $img) {
            @unlink(public_path($img->image_path));
        }

        DB::table('products')->where('id', $id)->delete();

        $this->exportProductsToSeeder();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produkt bol odstránený.');
    }

    private function normalizeSport(?string $sport): ?string
    {
        if ($sport === null) {
            return null;
        }

        $sport = trim($sport);

        if ($sport === '') {
            return null;
        }

        return mb_strtolower($sport, 'UTF-8');
    }

    private function normalizeColor(?string $color): ?string
    {
        if ($color === null) {
            return null;
        }

        $color = trim($color);

        if ($color === '') {
            return null;
        }

        return mb_strtolower($color, 'UTF-8');
    }

    private function exportProductsToSeeder(): void
    {
        $data = [];

        $categories = DB::table('categories')->orderBy('id')->get();

        foreach ($categories as $category) {
            $categoryData = [
                'name' => $category->name,
                'subcategories' => [],
            ];

            $subcategories = DB::table('subcategories')
                ->where('category_id', $category->id)
                ->orderBy('id')
                ->get();

            foreach ($subcategories as $subcategory) {
                $subcategoryData = [
                    'name' => $subcategory->name,
                    'products' => [],
                ];

                $products = DB::table('products')
                    ->where('subcategory_id', $subcategory->id)
                    ->orderBy('id')
                    ->get();

                foreach ($products as $product) {
                    $variants = DB::table('product_variants')
                        ->where('product_id', $product->id)
                        ->orderBy('id')
                        ->get()
                        ->map(function ($variant) {
                            return [
                                'color' => $this->normalizeColor($variant->color),
                                'size' => $variant->size,
                                'price' => (float) $variant->price,
                                'stock' => (int) $variant->stock,
                                'is_active' => (bool) $variant->is_active,
                            ];
                        })
                        ->toArray();

                    $images = DB::table('product_images')
                        ->where('product_id', $product->id)
                        ->orderBy('sort_order')
                        ->get()
                        ->map(function ($image) {
                            return [
                                'image_path' => $image->image_path,
                                'color' => $this->normalizeColor($image->color),
                                'sort_order' => (int) $image->sort_order,
                                'is_main' => (bool) $image->is_main,
                            ];
                        })
                        ->toArray();

                    $subcategoryData['products'][] = [
                        'name' => $product->name,
                        'gender' => $product->gender,
                        'sport' => $this->normalizeSport($product->sport),
                        'description' => $product->description,
                        'variants' => $variants,
                        'images' => $images,
                    ];
                }

                $categoryData['subcategories'][] = $subcategoryData;
            }

            $data[] = $categoryData;
        }

        $exportedData = var_export($data, true);

        $content = <<<'PHP'
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $data = __PRODUCT_DATA__;

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
PHP;

        $content = str_replace('__PRODUCT_DATA__', $exportedData, $content);

        file_put_contents(database_path('seeders/ProductSeeder.php'), $content);
    }
}