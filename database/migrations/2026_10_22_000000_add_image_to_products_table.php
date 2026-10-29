<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::table('products', function (Blueprint $t) {
      $t->string('image')->nullable()->after('note');
    });

    // Pasang foto ke produk yang sudah ada (tanpa menghapus data), berdasarkan database/product_images.php
    $map = require database_path('product_images.php');
    foreach ($map as $key => $file) {
      [$name, $size] = explode('|', $key);
      DB::table('products')->where('name', $name)->where('size', (int) $size)->update(['image' => $file]);
    }
  }
  public function down(): void {
    Schema::table('products', function (Blueprint $t) {
      $t->dropColumn('image');
    });
  }
};
