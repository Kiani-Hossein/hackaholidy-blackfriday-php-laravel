<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Basket;
use App\Models\Product;
use App\Models\User;
use App\Models\Invoice;

class BasketControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_add_an_item_to_the_basket()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->postJson('/api/v1/blackfriday/basket/add', [
            'ProductId' => $product->asin,
            'UserId' => $user->id,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'ProductId' => $product->asin,
                'UserId' => $user->id,
                'IsCheckedOut' => false,
            ]);

        $this->assertDatabaseHas('Baskets', [
            'ProductId' => $product->asin,
            'UserId' => $user->id,
            'IsCheckedOut' => false,
        ]);
    }

    /** @test */
    public function it_can_checkout_a_basket()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $basket = Basket::create([
            'ProductId' => $product->asin,
            'UserId' => $user->id,
            'IsCheckedOut' => false,
        ]);

        $response = $this->postJson('/api/v1/blackfriday/basket/checkout', [
            'BasketId' => $basket->BasketId,
            'UserId' => $user->id,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'BasketId' => $basket->BasketId,
                'UserId' => $user->id,
            ]);

        $this->assertDatabaseHas('Baskets', [
            'BasketId' => $basket->BasketId,
            'IsCheckedOut' => true,
        ]);

        $this->assertDatabaseHas('Invoices', [
            'BasketId' => $basket->BasketId,
            'UserId' => $user->id,
        ]);
    }
}
