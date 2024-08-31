<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    //

    public function home(Request $request){
        $categories = Category::all();
        $products = Product::all();
        return view('welcome', compact('products','categories'));
    }

    public function home_api(Request $request){
        $categories = Category::all();
        $products = Product::all();

           return response()->json([
        'categories' => $categories,
        'products' => $products
       ]);
    }




    public function index_api($slug, Request $request)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();

    
        // Start the query
        $productsQuery = $category ? $category->products() : Product::query(); // If no category, get all products
    
        // Apply sorting
        $sort = $request->query('sort');
    
        if ($sort === 'best_sell') {

            // $products =  $productsQuery->orderDetails->sum('quantity')->sortByDesc();

            $products = $productsQuery->with('orderDetails')
            ->get()
            ->sortByDesc(function ($product) {
                // Calculate total sold quantity for sorting
                return $product->orderDetails->sum('quantity');
            });
    
        } elseif ($sort === 'top_rated') {
            $productsQuery->with('reviews')
                ->orderByRaw('(SELECT AVG(rating) FROM product_reviews WHERE product_id = products.id) DESC');
        } elseif ($sort === 'price_high_to_low') {
            $productsQuery->orderBy('price', 'desc');
        } elseif ($sort === 'price_low_to_high') {
            $productsQuery->orderBy('price', 'asc');
        } else {
            $productsQuery->orderBy('name', 'asc'); // Default sort
        }

        $products = $productsQuery->get();


        return response()->json([
            'categories' => $categories,
            'products' => $products
           ]);

     
    }


    public function index(Request $request)
    {
        $categories = Category::all();
    
        // Get the category based on the slug
        $categorySlug = $request->query('category');
        $category = Category::where('slug', $categorySlug)->first();
    
        // Start the query
        $productsQuery = $category ? $category->products() : Product::query(); // If no category, get all products
    
        // Apply sorting
        $sort = $request->query('sort');
    
        if ($sort === 'best_sell') {

            // $products =  $productsQuery->orderDetails->sum('quantity')->sortByDesc();

            $products = $productsQuery->with('orderDetails')
            ->get()
            ->sortByDesc(function ($product) {
                // Calculate total sold quantity for sorting
                return $product->orderDetails->sum('quantity');
            });
    
        } elseif ($sort === 'top_rated') {
            $productsQuery->with('reviews')
                ->orderByRaw('(SELECT AVG(rating) FROM product_reviews WHERE product_id = products.id) DESC');
        } elseif ($sort === 'price_high_to_low') {
            $productsQuery->orderBy('price', 'desc');
        } elseif ($sort === 'price_low_to_high') {
            $productsQuery->orderBy('price', 'asc');
        } else {
            $productsQuery->orderBy('name', 'asc'); // Default sort
        }

        $products = $productsQuery->get();
    
        return view('welcome', compact('products', 'categories'));
    }



    // public function index(Request $request)
    // {
    //     $categories = Category::all();
    
    //     // Get the category based on the slug
    //     $categorySlug = $request->query('category');
    //     $category = Category::where('slug', $categorySlug)->first();
    
    //     // Start the query
    //     $productsQuery = $category ? $category->products() : Product::query();
    
    //     // Apply sorting
    //     $sort = $request->query('sort');
    
    //     if ($sort === 'best_sell') {
    //         $productsQuery = $productsQuery->select('products.id', 'products.name', 'products.price', 'products.slug')
    //             ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
    //             ->selectRaw('IFNULL(SUM(order_details.quantity), 0) AS total_sold')
    //             ->groupBy('products.id', 'products.name', 'products.price', 'products.slug')
    //             ->orderBy('total_sold', 'desc');
    //     } elseif ($sort === 'top_rated') {
    //         $productsQuery = $productsQuery->select('products.id', 'products.name', 'products.price', 'products.slug')
    //             ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id')
    //             ->selectRaw('IFNULL(AVG(product_reviews.rating), 0) AS average_rating')
    //             ->groupBy('products.id', 'products.name', 'products.price', 'products.slug')
    //             ->orderBy('average_rating', 'desc');
    //     } elseif ($sort === 'price_high_to_low') {
    //         $productsQuery->orderBy('price', 'desc');
    //     } elseif ($sort === 'price_low_to_high') {
    //         $productsQuery->orderBy('price', 'asc');
    //     } else {
    //         $productsQuery->orderBy('name', 'asc'); // Default sort
    //     }
    
    //     // Execute the query and retrieve products
    //     $products = $productsQuery->get();
        
    //     return view('welcome', compact('products', 'categories'));
    // }
    

    
}
