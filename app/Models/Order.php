<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model {
  protected $guarded=[];
  public function items(){ return $this->hasMany(OrderItem::class); }

  public function paymentMethodLabel(): string
  {
    return match ($this->payment_method) {
      'ewallet' => 'E-Wallet',
      'mbanking' => 'M-Banking',
      'qris' => 'QRIS',
      default => 'Belum dipilih',
    };
  }

  public function paymentStatusLabel(): string
  {
    return match ($this->payment_status) {
      'terbayar' => 'Terkonfirmasi',
      'ditolak' => 'Perlu konfirmasi ulang',
      default => 'Menunggu konfirmasi',
    };
  }
    public function getNumberAttribute(): string
  {
    return $this->order_no ?? ('CM-' . str_pad($this->id, 4, '0', STR_PAD_LEFT));
  }
}

