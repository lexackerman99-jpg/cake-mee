@extends('layout')
@section('content')
<h2>Checkout</h2>
<div class="co">
  <div class="box left">
    <form method="POST" action="{{ route('checkout.place') }}">@csrf
      <label>Nama</label>
      <input name="customer_name" value="{{ old('customer_name') }}">
      @error('customer_name')<div class="err">{{ $message }}</div>@enderror
      <label>No. WhatsApp</label>
      <input name="phone" value="{{ old('phone') }}" inputmode="tel" placeholder="08xxxxxxxxxx">
      @error('phone')<div class="err">{{ $message }}</div>@enderror
      <label>Alamat</label>
      <textarea name="address" rows="3">{{ old('address') }}</textarea>
      @error('address')<div class="err">{{ $message }}</div>@enderror
      <label>Catatan (tulisan di kue, dll)</label>
      <textarea name="note" rows="2">{{ old('note') }}</textarea>
      @error('note')<div class="err">{{ $message }}</div>@enderror

      <fieldset class="payment-options">
        <legend>Metode Pembayaran</legend>
        <p class="payment-help">Pilih metode pembayaran. Admin akan mengirimkan detail pembayaran setelah pesanan dikonfirmasi.</p>

        @php
          $currentMethod = old('payment_method');
          $isEwallet = $currentMethod && str_starts_with($currentMethod, 'ewallet');
          $isMbanking = $currentMethod && str_starts_with($currentMethod, 'mbanking');
        @endphp

        {{-- 1. E-Wallet --}}
        <div class="payment-card-group {{ $isEwallet ? 'open' : '' }}" id="group-ewallet">
          <label class="payment-option" onclick="handleGroupClick('ewallet', 'ewallet_gopay')">
            <input type="radio" name="payment_category" value="ewallet" {{ $isEwallet ? 'checked' : '' }}>
            <span class="payment-option-copy">
              <strong>E-Wallet</strong>
              <small>Transfer melalui aplikasi e-wallet (GoPay, DANA, OVO)</small>
            </span>
          </label>
          <div class="payment-sub-box">
            <span class="payment-sub-label">Pilih aplikasi e-wallet:</span>
            <div class="payment-sub-grid">
              @foreach([
                'ewallet_gopay' => 'GoPay',
                'ewallet_dana'  => 'DANA',
                'ewallet_ovo'   => 'OVO',
              ] as $val => $name)
                <label class="payment-sub-chip">
                  <input type="radio" name="payment_method" value="{{ $val }}" @checked($currentMethod === $val) onchange="syncCategory('ewallet')">
                  <span>{{ $name }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>

        {{-- 2. M-Banking --}}
        <div class="payment-card-group {{ $isMbanking ? 'open' : '' }}" id="group-mbanking">
          <label class="payment-option" onclick="handleGroupClick('mbanking', 'mbanking_bca')">
            <input type="radio" name="payment_category" value="mbanking" {{ $isMbanking ? 'checked' : '' }}>
            <span class="payment-option-copy">
              <strong>M-Banking</strong>
              <small>Transfer melalui mobile banking (BCA, BRI, BNI, Mandiri)</small>
            </span>
          </label>
          <div class="payment-sub-box">
            <span class="payment-sub-label">Pilih bank:</span>
            <div class="payment-sub-grid">
              @foreach([
                'mbanking_bca'     => 'BCA',
                'mbanking_bri'     => 'BRI',
                'mbanking_bni'     => 'BNI',
                'mbanking_mandiri' => 'Mandiri',
              ] as $val => $name)
                <label class="payment-sub-chip">
                  <input type="radio" name="payment_method" value="{{ $val }}" @checked($currentMethod === $val) onchange="syncCategory('mbanking')">
                  <span>{{ $name }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>

        {{-- 3. QRIS --}}
        <label class="payment-option" onclick="handleDirectClick()">
          <input type="radio" name="payment_method" value="qris" @checked($currentMethod === 'qris')>
          <span class="payment-option-copy">
            <strong>QRIS</strong>
            <small>Pembayaran dengan scan QRIS</small>
          </span>
        </label>

        {{-- 4. COD --}}
        <label class="payment-option" onclick="handleDirectClick()">
          <input type="radio" name="payment_method" value="cod" @checked($currentMethod === 'cod')>
          <span class="payment-option-copy">
            <strong>COD (Bayar di Tempat)</strong>
            <small>Bayar langsung secara tunai saat pesanan diterima</small>
          </span>
        </label>

        @error('payment_method')<div class="err">{{ $message }}</div>@enderror
      </fieldset>

      <button class="btn">Buat Pesanan</button>
    </form>
  </div>

  <aside class="sum">
    <h3>Ringkasan Pesanan</h3>
    @foreach($items as $x)
      <div class="row"><span>{{ $x->p->name }} <small>uk. {{ $x->p->size }} × {{ $x->qty }}</small></span><b>Rp {{ number_format($x->sub,0,',','.') }}</b></div>
    @endforeach
    <div class="row"><span>Subtotal</span><span>Rp {{ number_format($t['sub'],0,',','.') }}</span></div>
    <div class="row disc"><span>Diskon promo 10%</span><span>- Rp {{ number_format($t['disc'],0,',','.') }}</span></div>
    <div class="row tot"><span>Total</span><b>Rp {{ number_format($t['total'],0,',','.') }}</b></div>
    @if($t['qty']<3)
      <p class="sumhint">Tambah {{ 3-$t['qty'] }} item lagi untuk diskon 10%.</p>
    @endif
  </aside>
</div>

<script>
function handleGroupClick(group, defaultSub) {
  var grp = document.getElementById('group-' + group);
  var checked = grp ? grp.querySelector('input[name="payment_method"]:checked') : null;
  if (!checked) {
    var def = grp ? grp.querySelector('input[value="' + defaultSub + '"]') : null;
    if (def) { def.checked = true; }
  }
  document.querySelectorAll('.payment-card-group').forEach(function(el){ el.classList.remove('open'); });
  if (grp) grp.classList.add('open');
  document.querySelectorAll('input[name="payment_category"]').forEach(function(r){
    r.checked = (r.value === group);
  });
}
function syncCategory(group) {
  var cat = document.querySelector('input[name="payment_category"][value="' + group + '"]');
  if (cat) cat.checked = true;
  document.querySelectorAll('.payment-card-group').forEach(function(el){
    if (el.id !== 'group-' + group) el.classList.remove('open');
    else el.classList.add('open');
  });
}
function handleDirectClick() {
  document.querySelectorAll('.payment-card-group').forEach(function(el){ el.classList.remove('open'); });
  document.querySelectorAll('input[name="payment_category"]').forEach(function(r){ r.checked = false; });
}
</script>
@endsection