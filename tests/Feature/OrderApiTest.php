<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Order;
use PHPUnit\Framework\Attributes\Test;

class OrderApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_a_new_order(): void
    {
        $payload = [
            'customer_name' => 'John Doe',
            'item_name'     => 'T-Shirt',
            'price'         => 499.99,
            'status'        => 'pending',
        ];

        $response = $this->postJson('/api/orders', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'customer_name' => 'John Doe',
                'item_name'     => 'T-Shirt',
                'status'        => 'pending',
            ]);

        $this->assertDatabaseHas('orders', $payload);
    }

    #[Test]
    public function it_updates_an_order_status(): void
    {
        $order = Order::create([
            'customer_name' => 'John Doe',
            'item_name'     => 'T-Shirt',
            'price'         => 899.00,
            'status'        => 'paid',
        ]);

        $response = $this->patchJson("/api/orders/{$order->id}", [
            'status' => 'cancelled',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['status' => 'cancelled']);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'cancelled',
        ]);
    }
}
