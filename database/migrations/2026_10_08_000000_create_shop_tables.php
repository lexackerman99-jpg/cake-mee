<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
  public function up(): void {
    Schema::create('products', function (Blueprint $t) {
      $t->id(); $t->string('name'); $t->string('category'); $t->unsignedSmallInteger('size');
      $t->unsignedInteger('price'); $t->string('note')->nullable(); $t->timestamps();
    });
    Schema::create('orders', function (Blueprint $t) {
      $t->id(); $t->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
      $t->string('customer_name'); $t->string('phone'); $t->text('address'); $t->text('note')->nullable();
      $t->unsignedInteger('subtotal'); $t->unsignedInteger('discount')->default(0); $t->unsignedInteger('total');
      $t->string('status')->default('menunggu'); $t->timestamps();
    });
    Schema::create('order_items', function (Blueprint $t) {
      $t->id(); $t->foreignId('order_id')->constrained()->cascadeOnDelete();
      $t->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
      $t->string('name'); $t->unsignedInteger('price'); $t->unsignedInteger('qty'); $t->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('order_items'); Schema::dropIfExists('orders'); Schema::dropIfExists('products'); }
};
