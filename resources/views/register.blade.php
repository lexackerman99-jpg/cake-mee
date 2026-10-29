@extends('layout')
@section('content')
<div class="box">
  <h2>Daftar</h2>
  <p class="hint">Buat akun untuk klaim promo dan checkout lebih cepat.</p>
  <form method="POST" action="{{ route('register.submit') }}">@csrf
    <label>Nama</label>
    <input name="name" value="{{ old('name') }}" autofocus>
    @error('name')<div class="err">{{ $message }}</div>@enderror
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}">
    @error('email')<div class="err">{{ $message }}</div>@enderror
    <label>Password</label>
    <input type="password" name="password">
    @error('password')<div class="err">{{ $message }}</div>@enderror
    <label>Ulangi Password</label>
    <input type="password" name="password_confirmation">
    <label>No. WhatsApp <span class="opt">(opsional)</span></label>
    <input name="phone" value="{{ old('phone') }}" inputmode="tel" placeholder="08xxxxxxxxxx">
    @error('phone')<div class="err">{{ $message }}</div>@enderror
    <label>Alamat <span class="opt">(opsional)</span></label>
    <textarea name="address" rows="2" placeholder="Dipakai untuk mengisi checkout otomatis">{{ old('address') }}</textarea>
    @error('address')<div class="err">{{ $message }}</div>@enderror
    <button class="btn">Daftar</button>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
  </form>
</div>
@endsection
