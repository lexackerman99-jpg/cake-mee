<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_displays_the_supported_payment_methods(): void
    {
        $product = $this->createProduct();
        $this->withSession(['cart' => [$product->id => 1]]);

        $response = $this->get(route('checkout'));

        $response->assertOk();
        $response->assertSee('E-Wallet');
        $response->assertSee('M-Banking');
        $response->assertSee('QRIS');
    }

    public function test_checkout_saves_selected_payment_method_and_waits_for_manual_confirmation(): void
    {
        $product = $this->createProduct();
        $this->withSession(['cart' => [$product->id => 2]]);

        $response = $this->post(route('checkout.place'), [
            'customer_name' => 'Pelanggan Uji',
            'phone' => '08123456789',
            'address' => 'Alamat Uji',
            'payment_method' => 'qris',
        ]);

        $order = Order::firstOrFail();

        $response->assertRedirect(route('order.done'));
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'payment_method' => 'qris',
            'payment_status' => 'menunggu',
            'total' => 250000,
        ]);
        $response->assertSessionMissing('cart');
        $this->assertSame('QRIS', $order->paymentMethodLabel());
    }

    public function test_checkout_rejects_unsupported_payment_method_without_creating_order(): void
    {
        $product = $this->createProduct();
        $this->withSession(['cart' => [$product->id => 1]]);

        $response = $this->post(route('checkout.place'), [
            'customer_name' => 'Pelanggan Uji',
            'phone' => '08123456789',
            'address' => 'Alamat Uji',
            'payment_method' => 'transfer-langsung',
        ]);

        $response->assertSessionHasErrors('payment_method');
        $this->assertDatabaseCount('orders', 0);
        $response->assertSessionHas('cart', [$product->id => 1]);
    }

    private function createProduct(): Product
    {
        return Product::create([
            'name' => 'Cake Uji',
            'category' => 'Cake Besar',
            'size' => 28,
            'price' => 125000,
        ]);
    }
}
