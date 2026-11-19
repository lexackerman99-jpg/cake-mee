<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_open_checkout_and_see_supported_payment_methods(): void
    {
        $product = $this->createProduct();
        $this->withSession(['cart' => [$product->id => 1]]);

        $response = $this->get(route('checkout'));

        $response->assertOk();
        $this->assertGuest();
        $response->assertSee('E-Wallet');
        $response->assertSee('M-Banking');
        $response->assertSee('QRIS');
    }

    public function test_guest_can_place_order_and_wait_for_manual_payment_confirmation(): void
    {
        $product = $this->createProduct();
        $this->withSession(['cart' => [$product->id => 2]]);

        $response = $this->post(route('checkout.place'), [
            'customer_name' => 'Pelanggan Uji',
            'phone' => '08123456789',
            'address' => 'Alamat Uji',
            'payment_method' => 'qris',
        ]);

        $response->assertRedirect(route('order.done'));
        $this->assertGuest();
        $order = Order::firstOrFail();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'order_no' => 'CM-0001',
            'payment_method' => 'qris',
            'payment_status' => 'menunggu',
            'total' => 250000,
        ]);

        $response->assertSessionMissing('cart');
        $this->assertSame('QRIS', $order->paymentMethodLabel());

        $confirmation = $this->get(route('order.done'));

        $confirmation->assertOk();
        $confirmation->assertSee('Pesanan #CM-0001');
        $this->assertGuest();
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
