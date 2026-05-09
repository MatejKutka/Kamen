<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('product_variants')
            ->join('products', 'products.id', '=', 'product_variants.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->leftJoin('product_images', function ($join) {
                $join->on('products.id', '=', 'product_images.product_id')
                    ->on('product_variants.color', '=', 'product_images.color')
                    ->where('product_images.is_main', true);
            })

            ->when($request->search, function ($q, $search) {
                $q->where(function ($query) use ($search) {
                    $query->where('products.name', 'like', "%{$search}%")
                        ->orWhere('product_variants.color', 'like', "%{$search}%")
                        ->orWhere('products.sport', 'like', "%{$search}%");
                });
            })

            ->when($request->gender, function ($q, $gender) {
                $genders = collect((array) $gender)
                    ->map(fn ($g) => mb_strtolower(trim($g), 'UTF-8'))
                    ->filter()
                    ->values()
                    ->all();

                $q->whereIn(DB::raw('LOWER(TRIM(products.gender))'), $genders);
            })

            ->when($request->category, function ($q, $category) {
                $category = mb_strtolower(trim($category), 'UTF-8');

                $q->whereRaw('LOWER(TRIM(categories.name)) = ?', [$category]);
            })

            ->when($request->subcategory, function ($q, $subcategory) {
                $subcategory = mb_strtolower(trim($subcategory), 'UTF-8');

                $q->whereRaw('LOWER(TRIM(subcategories.name)) = ?', [$subcategory]);
            })

            ->when($request->sport, function ($q, $sport) {
                $sports = collect((array) $sport)
                    ->map(fn ($s) => mb_strtolower(trim($s), 'UTF-8'))
                    ->filter()
                    ->values()
                    ->all();

                $q->whereIn(DB::raw('LOWER(TRIM(products.sport))'), $sports);
            })

            ->when($request->price_from, function ($q, $priceFrom) {
                $q->where('product_variants.price', '>=', $priceFrom);
            })

            ->when($request->price_to, function ($q, $priceTo) {
                $q->where('product_variants.price', '<=', $priceTo);
            })

            ->when($request->color, function ($q, $colors) {
                $colors = collect((array) $colors)
                    ->map(fn ($color) => mb_strtolower(trim($color), 'UTF-8'))
                    ->filter()
                    ->values()
                    ->all();

                $q->whereIn(
                    DB::raw('LOWER(TRIM(product_variants.color))'),
                    $colors
                );
            })

            ->when($request->size, function ($q, $sizes) {
                $sizes = collect((array) $sizes)
                    ->map(fn ($size) => mb_strtolower(trim($size), 'UTF-8'))
                    ->filter()
                    ->values()
                    ->all();

                $q->whereIn(
                    DB::raw('LOWER(TRIM(product_variants.size))'),
                    $sizes
                );
            })

            ->where('product_variants.is_active', true)

            ->select(
                DB::raw('MIN(product_variants.id) as variant_id'),
                'products.id as product_id',
                'products.name',
                'products.gender',
                'product_variants.color',
                DB::raw('MIN(product_variants.price) as price'),
                'product_images.image_path'
            )

            ->groupBy(
                'products.id',
                'products.name',
                'products.gender',
                'product_variants.color',
                'product_images.image_path'
            );

        switch ($request->get('sort')) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;

            case 'newest':
                $query->orderBy('product_id', 'desc');
                break;

            case 'popular':
            default:
                $query->orderBy('product_id', 'desc');
                break;
        }

        $products = $query->get();

        return view('listofproduct', compact('products'));
    }
}