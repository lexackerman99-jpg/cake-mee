<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_quantity_starts_at_zero(): void
    {
        $this->createProduct('Cake pilihan');

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('name="qty[', false);
        $response->assertSee('value="0" min="0" max="99"', false);
    }

    public function test_adding_product_with_zero_quantity_does_not_add_it_to_cart(): void
    {
        $product = $this->createProduct('Cake pilihan');

        $response = $this->from(route('home'))->post(route('cart.add'), ['qty' => [$product->id => 0]]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('cart_warning', 'Pilih jumlah kue di atas 0 untuk menambahkannya ke keranjang.');
        $response->assertSessionMissing('cart');
    }

    public function test_adding_multiple_positive_quantities_adds_all_selected_products_to_cart(): void
    {
        $firstProduct = $this->createProduct('Cake pertama');
        $secondProduct = $this->createProduct('Cake kedua');

        $response = $this->from(route('home'))->post(route('cart.add'), [
            'qty' => [
                $firstProduct->id => 1,
                $secondProduct->id => 1,
            ],
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('cart', [
            $firstProduct->id => 1,
            $secondProduct->id => 1,
        ]);

        $cart = $this->get(route('cart'));

        $cart->assertOk();
        $cart->assertSee('Cake pertama uk.28');
        $cart->assertSee('Cake kedua uk.28');
        $cart->assertSee('>2</span>', false);
    }

    public function test_negative_product_quantity_is_rejected(): void
    {
        $product = $this->createProduct('Cake pilihan');

        $response = $this->from(route('home'))->post(route('cart.add'), ['qty' => [$product->id => -1]]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('cart_warning', 'Jumlah kue harus berupa bilangan bulat 0 atau lebih.');
        $menuResponse = $this->get(route('home'));
        $menuResponse->assertSee('Jumlah kue harus berupa bilangan bulat 0 atau lebih.');
        $menuResponse->assertSessionMissing('cart');
    }

    public function test_unavailable_products_are_removed_from_cart_and_badge_count(): void
    {
        $product = $this->createProduct('Cake yang dihapus');
        $this->post(route('cart.add'), ['qty' => [$product->id => 4]]);
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
        $this->post(route('cart.add'), ['qty' => [
            $deletedProduct->id => 4,
            $availableProduct->id => 0,
        ]]);
        $this->post(route('cart.add'), ['qty' => [
            $deletedProduct->id => 0,
            $availableProduct->id => 2,
        ]]);
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
