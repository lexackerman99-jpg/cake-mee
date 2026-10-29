<?php
namespace App\Http\Controllers;
use App\Models\{Product,Order};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ShopController extends Controller {
  const WA = '6281341591765';
  private function items(){
    $c = session('cart', []);
    if (!is_array($c) || empty($c)) {
      if (!is_array($c)) session(['cart'=>[]]);
      return collect();
    }

    $products = Product::whereIn('id', array_keys($c))->get();
    $available = $products->keyBy('id');
    $validCart = array_intersect_key($c, $available->all());

    if (count($validCart) !== count($c)) {
      session(['cart'=>$validCart]);
      session()->flash('cart_warning','Beberapa produk di keranjang sudah tidak tersedia dan telah dihapus. Silakan pilih kembali dari menu.');
    }

    return $products
      ->filter(fn($p)=>array_key_exists($p->id,$validCart))
      ->map(fn($p)=>(object)['p'=>$p,'qty'=>$validCart[$p->id],'sub'=>$p->price*$validCart[$p->id]]);
  }
  private function calc($items){
    $sub=$items->sum('sub'); $qty=$items->sum('qty');
    $disc = $qty>=3 ? (int)round($sub*0.10) : 0; // promo: minimal beli 3 item, diskon 10%
    return ['sub'=>$sub,'qty'=>$qty,'disc'=>$disc,'total'=>$sub-$disc];
  }
  public function index(){ return view('menu',['groups'=>Product::orderBy('id')->get()->groupBy('category')]); }
  public function add(Request $r, Product $product){
    $this->items();
    $q = max(1,(int)$r->input('qty',1)); $c = session('cart',[]);
    $c[$product->id] = ($c[$product->id] ?? 0) + $q; session(['cart'=>$c]);
    return back()->with('ok',"{$product->name} ukuran {$product->size} ditambahkan ke keranjang.");
  }
  public function remove(Product $product){ $this->items(); $c=session('cart',[]); unset($c[$product->id]); session(['cart'=>$c]); return back(); }
  public function cart(){ $i=$this->items(); return view('cart',['items'=>$i,'t'=>$this->calc($i)]); }
  public function checkout(){
    $i=$this->items(); if($i->isEmpty()) return redirect()->route('home')->with('ok','Keranjang masih kosong.');
    return view('checkout',['items'=>$i,'t'=>$this->calc($i)]);
  }
  public function place(Request $r){
    $d = $r->validate([
      'customer_name'=>['required','string','max:100'],
      'phone'=>['required','string','max:20'],
      'address'=>['required','string','max:1000'],
      'note'=>['nullable','string','max:1000'],
      'payment_method'=>['required','in:ewallet,mbanking,qris'],
    ]);
    $i=$this->items(); if($i->isEmpty()) return redirect()->route('home');
    $t=$this->calc($i);
    $o = DB::transaction(function() use($d,$i,$t){
      $o = Order::create($d+[
        'subtotal'=>$t['sub'],
        'discount'=>$t['disc'],
        'total'=>$t['total'],
        'payment_status'=>'menunggu',
      ]);
      foreach($i as $x) $o->items()->create(['product_id'=>$x->p->id,'name'=>$x->p->name.' uk.'.$x->p->size,'price'=>$x->p->price,'qty'=>$x->qty]);
      return $o;
    });
    session()->forget('cart'); session(['last_order'=>$o->id]);
    return redirect()->route('order.done');
  }
  public function done(){
    $o = Order::with('items')->findOrFail(session('last_order'));
    $m = "Assalamualaikum, saya mau konfirmasi pesanan #{$o->id}:\n";
    foreach($o->items as $x) $m .= "- {$x->name} x{$x->qty}\n";
    $m .= "Metode pembayaran: {$o->paymentMethodLabel()}\nStatus pembayaran: {$o->paymentStatusLabel()}\nDiskon: Rp ".number_format($o->discount,0,',','.')."\nTotal: Rp ".number_format($o->total,0,',','.')."\nNama: {$o->customer_name}\nHP: {$o->phone}\nAlamat: {$o->address}";
    return view('done',['o'=>$o,'wa'=>'https://wa.me/'.self::WA.'?text='.rawurlencode($m)]);
  }
}
