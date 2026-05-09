<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $variantSales = DB::table('order_items')
            ->select(
                'product_variant_id',
                DB::raw('SUM(quantity) as sold_count')
            )
            ->groupBy('product_variant_id');

        $query = DB::table('product_variants')
            ->join('products', 'products.id', '=', 'product_variants.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->leftJoinSub($variantSales, 'variant_sales', function ($join) {
                $join->on('variant_sales.product_variant_id', '=', 'product_variants.id');
            })
            ->leftJoin('product_images', function ($join) {
                $join->on('products.id', '=', 'product_images.product_id')
                    ->whereRaw('LOWER(TRIM(product_variants.color)) = LOWER(TRIM(product_images.color))')
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
                $q->whereIn('products.gender', (array) $gender);
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

                $q->whereIn(DB::raw('LOWER(TRIM(product_variants.color))'), $colors);
            })

            ->when($request->size, function ($q, $sizes) {
                $sizes = collect((array) $sizes)
                    ->map(fn ($size) => mb_strtolower(trim($size), 'UTF-8'))
                    ->filter()
                    ->values()
                    ->all();

                $q->whereIn(DB::raw('LOWER(TRIM(product_variants.size))'), $sizes);
            })

            ->where('product_variants.is_active', true)

            ->select(
                DB::raw('MIN(product_variants.id) as variant_id'),
                'products.id as product_id',
                'products.name',
                'products.gender',
                'products.created_at as product_created_at',
                'product_variants.color',
                DB::raw('MIN(product_variants.price) as price'),
                DB::raw('COALESCE(SUM(variant_sales.sold_count), 0) as sold_count'),
                'product_images.image_path'
            )

            ->groupBy(
                'products.id',
                'products.name',
                'products.gender',
                'products.created_at',
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
                $query->orderBy('product_created_at', 'desc');
                break;

            case 'popular':
            default:
                $query->orderBy('sold_count', 'desc')
                    ->orderBy('product_created_at', 'desc');
                break;
        }
        
        // tu menim cislo produktov na stranku
        $products = $query->paginate(12)->withQueryString();

        return view('listofproduct', compact('products'));
    }
}