<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'grand_total' => $this->faker->randomFloat(2, 50, 500),
            'shipping_cost' => $this->faker->randomFloat(2, 5, 20),
            'discount' => $this->faker->randomFloat(2, 0, 50),
            'user_id' => User::factory(),
        ];
    }
}
