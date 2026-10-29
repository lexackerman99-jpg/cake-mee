<?php
namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
  public function run(): void {
    $rows = [];
    foreach (['Coklat','Zebra','Sirikaya','Pelangi','Ambekuk','Orson (sirup ABC)'] as $f)
      $rows[] = ["Cake $f",'Cake Besar',28,165000,'Wanderpan'];
    $rows[] = ['Brudel','Brudel',28,120000,'Wanderpan'];
    $rows[] = ['Brudel Kecil','Brudel',22,65000,null];
    $rows[] = ['Cake Kecil','Cake Kecil',18,60000,'Menyesuaikan topping'];
    foreach ([[20,65000],[24,120000]] as [$s,$p]) {
      $rows[] = ['Cake Mix','Cake Sedang',$s,$p,null];
      $rows[] = ['Cake Keju','Cake Sedang',$s,$p,null];
    }
    foreach ([['Full Coklat',20,70000],['Full Coklat',16,50000],['Coklat Keju',20,65000],['Coklat Keju',16,45000],['Kenari',20,65000],['Kenari',16,45000]] as [$t,$s,$p])
      $rows[] = ["Cake Coklat Topping $t",'Cake Coklat',$s,$p,null];
    $img = require database_path('product_images.php'); // foto produk, lihat database/product_images.php
    foreach ($rows as [$n,$c,$s,$p,$note]) Product::create(['name'=>$n,'category'=>$c,'size'=>$s,'price'=>$p,'note'=>$note,'image'=>$img["$n|$s"] ?? null]);
  }
}
