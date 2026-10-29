<nav class="admin-nav" aria-label="Navigasi admin">
  <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Ringkasan</a>
  <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">Pesanan</a>
  <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Produk</a>
  <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">Laporan</a>
  <form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit">Keluar</button></form>
</nav>
