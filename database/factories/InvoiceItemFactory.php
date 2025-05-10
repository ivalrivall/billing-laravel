<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Products_Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice_Item>
 */
class InvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $unitPrice = $this->faker->randomFloat(2, 1, 1000);
        $quantity = $this->faker->numberBetween(1, 10);
        $totalPrice = $unitPrice * $quantity;

        return [
            'invoice_id' => Invoice::factory(),
            'product_service_id' => Products_Service::factory(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
        ];
    }
}
