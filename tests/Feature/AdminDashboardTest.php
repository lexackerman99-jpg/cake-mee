<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pages_redirect_guests_to_admin_login(): void
    {
        $response = $this->get(route('admin.products.index'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_regular_users_cannot_access_admin_pages(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_sign_in_to_admin_panel(): void
    {
        $admin = $this->createAdmin();

        $response = $this->post(route('admin.login.submit'), [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_customer_credentials_are_not_accepted_for_admin_login(): void
    {
        $customer = User::factory()->create();

        $response = $this->post(route('admin.login.submit'), [
            'email' => $customer->email,
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_admin_can_create_product_and_invalid_price_is_rejected(): void
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $invalidResponse = $this->post(route('admin.products.store'), [
            'name' => 'Cake Uji',
            'category' => 'Cake Besar',
            'size' => 28,
            'price' => 0,
        ]);
        $invalidResponse->assertSessionHasErrors('price');
        $this->assertDatabaseMissing('products', ['name' => 'Cake Uji']);

        $response = $this->post(route('admin.products.store'), [
            'name' => 'Cake Uji',
            'category' => 'Cake Besar',
            'size' => 28,
            'price' => 125000,
            'note' => 'Cokelat',
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'name' => 'Cake Uji',
            'price' => 125000,
        ]);
    }

    public function test_admin_can_update_order_status(): void
    {
        $this->actingAs($this->createAdmin());
        $order = Order::create([
            'customer_name' => 'Pelanggan Uji',
            'phone' => '08123456789',
            'address' => 'Alamat Uji',
            'subtotal' => 50000,
            'discount' => 0,
            'total' => 50000,
            'status' => 'menunggu',
        ]);

        $response = $this->patch(route('admin.orders.update', $order), [
            'status' => 'diproses',
            'payment_status' => 'terbayar',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'diproses',
            'payment_status' => 'terbayar',
        ]);
    }

    public function test_admin_can_view_product_catalog_and_order_details(): void
    {
        $this->actingAs($this->createAdmin());
        $product = Product::create([
            'name' => 'Cake Uji',
            'category' => 'Cake Besar',
            'size' => 28,
            'price' => 125000,
        ]);
        $order = Order::create([
            'customer_name' => 'Pelanggan Uji',
            'phone' => '08123456789',
            'address' => 'Alamat Uji',
            'subtotal' => 125000,
            'discount' => 0,
            'total' => 125000,
            'status' => 'menunggu',
        ]);
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'name' => 'Cake Uji uk.28',
            'price' => 125000,
            'qty' => 1,
        ]);

        $productsResponse = $this->get(route('admin.products.index'));
        $orderResponse = $this->get(route('admin.orders.show', $order));

        $productsResponse->assertOk();
        $productsResponse->assertSee('Cake Uji');
        $orderResponse->assertOk();
        $orderResponse->assertSee('Pelanggan Uji');
        $orderResponse->assertSee('Cake Uji uk.28');
    }

    public function test_product_pagination_uses_compact_admin_controls(): void
    {
        $this->actingAs($this->createAdmin());

        foreach (range(1, 13) as $number) {
            Product::create([
                'name' => "Cake Uji {$number}",
                'category' => 'Cake Besar',
                'size' => 28,
                'price' => 125000,
            ]);
        }

        $response = $this->get(route('admin.products.index'));

        $response->assertOk();
        $response->assertSee('Menampilkan 1–12 dari 13');
        $response->assertSee('Berikutnya');
        $response->assertSee('class="admin-pagination"', false);
    }

    public function test_customer_navigation_shows_order_action_label(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Pesan Sekarang');
    }

    public function test_report_excludes_cancelled_orders_from_revenue(): void
    {
        $this->actingAs($this->createAdmin());
        Order::create([
            'customer_name' => 'Pelanggan Aktif',
            'phone' => '08123456789',
            'address' => 'Alamat Uji',
            'subtotal' => 50000,
            'discount' => 0,
            'total' => 50000,
            'status' => 'selesai',
        ]);
        Order::create([
            'customer_name' => 'Pelanggan Batal',
            'phone' => '08123456789',
            'address' => 'Alamat Uji',
            'subtotal' => 90000,
            'discount' => 0,
            'total' => 90000,
            'status' => 'dibatalkan',
        ]);

        $response = $this->get(route('admin.reports.index', ['month' => now()->format('Y-m')]));

        $response->assertOk();
        $response->assertSee('Rp 50.000');
        $response->assertViewHas('ordersCount', 2);
    }

    public function test_admin_dashboard_shows_current_catalog_and_month_summary(): void
    {
        $this->actingAs($this->createAdmin());
        Product::create([
            'name' => 'Cake Uji',
            'category' => 'Cake Besar',
            'size' => 28,
            'price' => 125000,
        ]);
        Order::create([
            'customer_name' => 'Pelanggan Uji',
            'phone' => '08123456789',
            'address' => 'Alamat Uji',
            'subtotal' => 125000,
            'discount' => 0,
            'total' => 125000,
            'status' => 'menunggu',
        ]);

        $response = $this->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSee('Omzet bulan ini');
        $response->assertSee('Rp 125.000');
        $response->assertViewHas('totalProducts', 1);
    }

    private function createAdmin(): User
    {
        $user = User::factory()->create();
        $user->forceFill(['is_admin' => true])->save();

        return $user;
    }
}
