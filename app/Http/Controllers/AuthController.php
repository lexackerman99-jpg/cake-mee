<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
  public function loginForm(){ return view('login'); }
  public function registerForm(){ return view('register'); }
  public function login(Request $r){
    $c = $r->validate(['email'=>'required|email','password'=>'required']);
    if (Auth::attempt($c)) { $r->session()->regenerate(); return redirect()->intended('/'); }
    return back()->withErrors(['email'=>'Email atau password salah.'])->onlyInput('email');
  }
  public function register(Request $r){
    $d = $r->validate([
      'name'=>'required|max:100','email'=>'required|email|unique:users','password'=>'required|min:6|confirmed',
      'phone'=>'nullable|max:20','address'=>'nullable|max:500',
    ]);
    $user = User::create(collect($d)->only(['name','email','password'])->all()); // password otomatis di-hash (cast 'hashed', Laravel 11)
    $user->forceFill(['phone'=>$d['phone'] ?? null,'address'=>$d['address'] ?? null])->save(); // data opsional untuk isi otomatis checkout
    Auth::login($user);
    return redirect()->intended('/');
  }
  public function logout(Request $r){
    Auth::logout(); $r->session()->invalidate(); $r->session()->regenerateToken(); return redirect('/');
  }
}
