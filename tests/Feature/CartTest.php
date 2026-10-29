<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_unavailable_products_are_removed_from_cart_and_badge_count(): void
    {
        $product = $this->createProduct('Cake yang dihapus');
        $this->post(route('cart.add', $product), ['qty' => 4]);
        $product->delete();

        $response = $this->get(route('cart'));

        $response->assertOk();
        $response->assertSee('Beberapa produk di keranjang sudah tidak tersedia');
        $response->assertSee('Keranjang kosong.');
        $response->assertSee('>0</span>', false);
        $response->assertSessionHas('cart', []);
    }

    public function test_cart_keeps_available_products_when_another_product_is_deleted(): void
    {
        $deletedProduct = $this->createProduct('Cake yang dihapus');
        $availableProduct = $this->createProduct('Cake yang tersedia');
        $this->post(route('cart.add', $deletedProduct), ['qty' => 4]);
        $this->post(route('cart.add', $availableProduct), ['qty' => 2]);
        $deletedProduct->delete();

        $response = $this->get(route('cart'));

        $response->assertOk();
        $response->assertSee('Beberapa produk di keranjang sudah tidak tersedia');
        $response->assertSee('Cake yang tersedia uk.28');
        $response->assertDontSee('Cake yang dihapus');
        $response->assertSee('>2</span>', false);
        $response->assertSessionHas('cart', [$availableProduct->id => 2]);
    }

    private function createProduct(string $name): Product
    {
        return Product::create([
            'name' => $name,
            'category' => 'Cake Besar',
            'size' => 28,
            'price' => 125000,
        ]);
    }
}
