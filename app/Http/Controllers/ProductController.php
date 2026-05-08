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

            ->when($request->gender, fn ($q, $gender) =>
                $q->whereIn('products.gender', (array) $gender)
            )

            ->when($request->category, fn ($q, $category) =>
                $q->where('categories.name', $category)
            )

            ->when($request->subcategory, fn ($q, $subcategory) =>
                $q->where('subcategories.name', $subcategory)
            )

            ->when($request->sport, fn ($q, $sport) =>
                $q->whereIn('products.sport', (array) $sport)
            )

            ->when($request->price_from, fn ($q, $priceFrom) =>
                $q->where('product_variants.price', '>=', $priceFrom)
            )

            ->when($request->price_to, fn ($q, $priceTo) =>
                $q->where('product_variants.price', '<=', $priceTo)
            )

            // CASE INSENSITIVE COLOR FILTER
            ->when($request->color, function ($q, $colors) {

                $colors = array_map('strtolower', (array) $colors);

                $q->whereIn(
                    DB::raw('LOWER(product_variants.color)'),
                    $colors
                );
            })

            // CASE INSENSITIVE SIZE FILTER
            ->when($request->size, function ($q, $sizes) {

                $sizes = array_map('strtolower', (array) $sizes);

                $q->whereIn(
                    DB::raw('LOWER(product_variants.size)'),
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