<?php
namespace App\Http\Controllers;
use App\Models\{Product,Order};
use Illuminate\Http\RedirectResponse;
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
    $validCart = array_filter(
      array_intersect_key($c, $available->all()),
      static fn ($quantity): bool => filter_var($quantity, FILTER_VALIDATE_INT) !== false && (int) $quantity > 0,
    );

    if (count($validCart) !== count($c)) {
      session(['cart'=>$validCart]);
      session()->flash('cart_warning','Beberapa produk di keranjang sudah tidak tersedia atau memiliki jumlah tidak valid dan telah dihapus. Silakan pilih kembali dari menu.');
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
  public function add(Request $r): RedirectResponse {
    $submittedQuantities = $r->input('qty', []);

    if (!is_array($submittedQuantities)) {
      return back()->with('cart_warning', 'Pilihan jumlah kue tidak valid.');
    }

    $selectedQuantities = [];

    foreach ($submittedQuantities as $productId => $quantity) {
      $quantity = filter_var($quantity, FILTER_VALIDATE_INT);

      if ($quantity === false || $quantity < 0) {
        return back()->with('cart_warning', 'Jumlah kue harus berupa bilangan bulat 0 atau lebih.');
      }

      if ($quantity === 0) {
        continue;
      }

      $productId = filter_var((string) $productId, FILTER_VALIDATE_INT);

      if ($productId === false || $productId < 1) {
        return back()->with('cart_warning', 'Pilihan produk tidak valid.');
      }

      $selectedQuantities[$productId] = $quantity;
    }

    if (empty($selectedQuantities)) {
      return back()->with('cart_warning', 'Pilih jumlah kue di atas 0 untuk menambahkannya ke keranjang.');
    }

    $this->items();
    $products = Product::whereKey(array_keys($selectedQuantities))->get()->keyBy('id');

    if ($products->count() !== count($selectedQuantities)) {
      return back()->with('cart_warning', 'Sebagian kue yang dipilih sudah tidak tersedia. Muat ulang menu sebelum mencoba lagi.');
    }

    $cart = session('cart', []);

    foreach ($products as $product) {
      $cart[$product->id] = ($cart[$product->id] ?? 0) + $selectedQuantities[$product->id];
    }

    session(['cart' => $cart]);

    return back()->with('ok', count($selectedQuantities).' pilihan kue berhasil ditambahkan ke keranjang.');
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
      'payment_method'=>['required','in:ewallet,ewallet_gopay,ewallet_dana,ewallet_ovo,mbanking,mbanking_bri,mbanking_bni,mbanking_bca,mbanking_mandiri,qris,cod'],
    ]);
    $i=$this->items(); if($i->isEmpty()) return redirect()->route('home');
    $t=$this->calc($i);
    $o = DB::transaction(function() use($d,$i,$t){
      $next = (int) DB::table('orders')->lockForUpdate()->count() + 1;
      $o = Order::create($d+[
        'order_no'=>'CM-'.str_pad($next, 4, '0', STR_PAD_LEFT),
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
    $m = "Assalamualaikum Mom Sitty,\n\nSaya ingin mengonfirmasi pesanan *#{$o->number}*.\n\n";
    $m .= "*Rincian Pesanan*\n";
    $itemNumber = 1;
    foreach($o->items as $x) {
      $m .= "{$itemNumber}. {$x->name} — {$x->qty} pcs\n";
      $itemNumber++;
    }
    $m .= "\n*Pembayaran*\n";
    $m .= "Metode: {$o->paymentMethodLabel()}\nStatus: {$o->paymentStatusLabel()}\n\n";
    $m .= "*Ringkasan Pembayaran*\n";
    $m .= "Subtotal: Rp ".number_format($o->subtotal,0,',','.')."\n";
    $m .= "Diskon: Rp ".number_format($o->discount,0,',','.')."\n";
    $m .= "Total: *Rp ".number_format($o->total,0,',','.')."*\n\n";
    $m .= "*Data Pemesan*\n";
    $m .= "Nama: {$o->customer_name}\nNo. WhatsApp: {$o->phone}\nAlamat: {$o->address}";
    return view('done',['o'=>$o,'wa'=>'https://wa.me/'.self::WA.'?text='.rawurlencode($m)]);
  }
}
