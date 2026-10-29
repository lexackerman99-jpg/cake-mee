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
        @foreach(['ewallet' => ['E-Wallet', 'Transfer melalui aplikasi e-wallet'], 'mbanking' => ['M-Banking', 'Transfer melalui mobile banking'], 'qris' => ['QRIS', 'Pembayaran dengan scan QRIS']] as $value => [$label, $description])
          <label class="payment-option">
            <input type="radio" name="payment_method" value="{{ $value }}" @checked(old('payment_method') === $value) required>
            <span class="payment-option-copy"><strong>{{ $label }}</strong><small>{{ $description }}</small></span>
          </label>
        @endforeach
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
@endsection
