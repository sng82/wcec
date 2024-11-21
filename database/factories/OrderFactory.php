<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'price_ex_vat'              => 100,
            'order_status'              => 'paid',
            'payment_intent'            => $this->faker->word(),
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now(),
            'stripe_session_id'         => 'cs_test_a1blahBlah',
            'stripe_hosted_invoice_url' => $this->faker->url(),
            'product_name'              => 'registration',

            'user_id' => 1,
        ];
    }
}
