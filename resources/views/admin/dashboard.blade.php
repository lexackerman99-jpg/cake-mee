@extends('layout')

@section('content')
<section class="admin-page">
  @include('admin._nav')
  <div class="admin-heading">
    <div>
      <span class="eyebrow">Ringkasan</span>
      <h2>Dashboard Admin</h2>
      <p class="admin-subtitle">Pantau pesanan, katalog, dan penjualan Cake & Mee.</p>
    </div>
    <a class="btn" href="{{ route('admin.orders.index', ['status' => 'menunggu']) }}">Lihat pesanan menunggu</a>
  </div>

  <div class="stats-grid">
    <article class="stat-card"><span>Omzet bulan ini</span><strong>Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</strong></article>
    <article class="stat-card"><span>Total pesanan</span><strong>{{ number_format($totalOrders) }}</strong></article>
    <article class="stat-card"><span>Menunggu diproses</span><strong>{{ number_format($pendingOrders) }}</strong></article>
    <article class="stat-card"><span>Produk katalog</span><strong>{{ number_format($totalProducts) }}</strong></article>
    <article class="stat-card"><span>Akun pelanggan</span><strong>{{ number_format($totalUsers) }}</strong></article>
  </div>

  <section class="admin-panel">
    <div class="panel-heading">
      <div><h3>Pesanan terbaru</h3><p>Delapan pesanan terakhir masuk.</p></div>
      <a href="{{ route('admin.orders.index') }}">Semua pesanan →</a>
    </div>
    @if($recentOrders->isEmpty())
      <p class="empty-state">Belum ada pesanan.</p>
    @else
      <div class="table-wrap">
        <table class="admin-table">
          <thead><tr><th>No. Pesanan</th><th>Pelanggan</th><th>Tanggal</th><th>Status</th><th class="right">Total</th><th></th></tr></thead>
          <tbody>
          @foreach($recentOrders as $order)
            <tr>
              <td>#{{ $order->number }}</td>
              <td>{{ $order->customer_name }}</td>
              <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
              <td><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
              <td class="right">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
              <td><a class="btn sm" href="{{ route('admin.orders.show', $order) }}">Detail</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </section>
</section>
@endsection
