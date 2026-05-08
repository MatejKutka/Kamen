<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    //  INDEX 
    public function index()
    {
        $products = DB::table('products')
            ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->leftJoin('product_images', function ($join) {
                $join->on('products.id', '=', 'product_images.product_id')
                     ->where('product_images.is_main', true);
            })
            ->select(
                'products.id',
                'products.name',
                'products.gender',
                'products.sport',
                'categories.name as category_name',
                'subcategories.name as subcategory_name',
                'product_images.image_path',
                'products.created_at'
            )
            ->orderByDesc('products.created_at')
            ->get();

        return view('admin.products.index', compact('products'));
    }

    //  CREATE ─
    public function create()
    {
        $categories = DB::table('categories')->get();
        $subcategories = DB::table('subcategories')->get();

        return view('admin.products.create', compact('categories', 'subcategories'));
    }

    //  STORE 
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'subcategory_id' => 'required|exists:subcategories,id',
            'gender'         => 'required|string',
            'sport'          => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            // variants
            'variants'               => 'required|array|min:1',
            'variants.*.color'       => 'required|string|max:100',
            'variants.*.size'        => 'required|string|max:50',
            'variants.*.price'       => 'required|numeric|min:0',
            'variants.*.stock'       => 'required|integer|min:0',
            // images
            'images'         => 'nullable|array',
            'images.*'       => 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'main_image_index' => 'nullable|integer',
        ]);

        // 1. Vytvor produkt
        $productId = DB::table('products')->insertGetId([
            'name'           => $request->name,
            'subcategory_id' => $request->subcategory_id,
            'gender'         => $request->gender,
            'sport'          => $request->sport,
            'description'    => $request->description,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // 2. Vlož varianty
        foreach ($request->variants as $v) {
            DB::table('product_variants')->insert([
                'product_id' => $productId,
                'color'      => $v['color'],
                'size'       => $v['size'],
                'price'      => $v['price'],
                'stock'      => $v['stock'],
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Vlož obrázky
        if ($request->hasFile('images')) {
            $mainIndex = (int) $request->input('main_image_index', 0);
            foreach ($request->file('images') as $i => $file) {
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/products'), $filename);
                $path = 'images/products/' . $filename;
                DB::table('product_images')->insert([
                    'product_id' => $productId,
                    'image_path' => $path,
                    'color'      => $request->variants[0]['color'] ?? null,
                    'sort_order' => $i,
                    'is_main'    => ($i === $mainIndex),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produkt bol úspešne pridaný.');
    }

    //  EDIT ─
    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        abort_if(!$product, 404);

        $variants     = DB::table('product_variants')->where('product_id', $id)->get();
        $images       = DB::table('product_images')->where('product_id', $id)->orderBy('sort_order')->get();
        $categories   = DB::table('categories')->get();
        $subcategories = DB::table('subcategories')->get();

        return view('admin.products.edit', compact('product', 'variants', 'images', 'categories', 'subcategories'));
    }

    //  UPDATE ─
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'subcategory_id' => 'required|exists:subcategories,id',
            'gender'         => 'required|string',
            'sport'          => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'new_images'     => 'nullable|array',
            'new_images.*'   => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // 1. Aktualizuj produkt
        DB::table('products')->where('id', $id)->update([
            'name'           => $request->name,
            'subcategory_id' => $request->subcategory_id,
            'gender'         => $request->gender,
            'sport'          => $request->sport,
            'description'    => $request->description,
            'updated_at'     => now(),
        ]);

        // 2. Aktualizuj existujúce varianty
        if ($request->has('variants')) {
            foreach ($request->variants as $variantId => $v) {
                DB::table('product_variants')->where('id', $variantId)->update([
                    'color'      => $v['color'],
                    'size'       => $v['size'],
                    'price'      => $v['price'],
                    'stock'      => $v['stock'],
                    'is_active'  => 1,
                    'updated_at' => now(),
                ]);
            }
        }

        // 3. Pridaj nové varianty
        if ($request->has('new_variants')) {
            foreach ($request->new_variants as $v) {
                if (!empty($v['color']) && !empty($v['size'])) {
                    DB::table('product_variants')->insert([
                        'product_id' => $id,
                        'color'      => $v['color'],
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

        // 4. Zmaž označené obrázky
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imgId) {
                $img = DB::table('product_images')->where('id', $imgId)->first();
                if ($img) {
                    @unlink(public_path($img->image_path));
                    DB::table('product_images')->where('id', $imgId)->delete();
                }
            }
        }

        // 5. Pridaj nové obrázky
        if ($request->hasFile('new_images')) {
            $maxOrder = DB::table('product_images')->where('product_id', $id)->max('sort_order') ?? -1;
            foreach ($request->file('new_images') as $i => $file) {
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/products'), $filename);
                $path = 'images/products/' . $filename;
                DB::table('product_images')->insert([
                    'product_id' => $id,
                    'image_path' => $path,
                    'color'      => null,
                    'sort_order' => $maxOrder + $i + 1,
                    'is_main'    => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 6. Nastav hlavný obrázok
        if ($request->has('main_image_id')) {
            DB::table('product_images')->where('product_id', $id)->update(['is_main' => false]);
            DB::table('product_images')->where('id', $request->main_image_id)->update(['is_main' => true]);
        }

        return redirect()->route('admin.products.edit', $id)
                         ->with('success', 'Produkt bol aktualizovaný.');
    }

    //  DELETE VARIANT ─
    public function destroyVariant($id)
    {
        DB::table('product_variants')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Variant bol odstránený.');
    }

    //  DESTROY 
    public function destroy($id)
    {
        // Zmaž obrázky zo storage
        $images = DB::table('product_images')->where('product_id', $id)->get();
        foreach ($images as $img) {
            @unlink(public_path($img->image_path));
        }

        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produkt bol odstránený.');
    }
}