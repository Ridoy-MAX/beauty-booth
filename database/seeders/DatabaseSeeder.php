<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Order;
use App\Models\OrderDetail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Insert Users
        // $users = User::factory(10)->create();

        // // Insert Categories
        // $categories = Category::factory(5)->create();

        // // Insert Products
        // $products = Product::factory(20)->create();

        // // Attach Products to Categories
        // $products->each(function ($product) use ($categories) {
        //     $product->categories()->attach(
        //         $categories->random(rand(1, 3))->pluck('id')->toArray()
        //     );
        // });

        // Insert Product Reviews
        ProductReview::factory(20)->create();

        // Insert Orders
        // $orders = Order::factory(15)->create();

        // // Insert Order Details
        // $orders->each(function ($order) use ($products) {
        //     $orderDetails = OrderDetail::factory(rand(1, 3))->make([
        //         'order_id' => $order->id,
        //         'product_id' => $products->random()->id,
        //     ]);
        //     $order->orderDetails()->saveMany($orderDetails);
        // });
    }
}
