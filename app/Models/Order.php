<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model {
  protected $guarded=[];
  public function items(){ return $this->hasMany(OrderItem::class); }

  public function paymentMethodLabel(): string
  {
    return match ($this->payment_method) {
      'ewallet_gopay' => 'E-Wallet (GoPay)',
      'ewallet_dana' => 'E-Wallet (DANA)',
      'ewallet_ovo' => 'E-Wallet (OVO)',
      'ewallet' => 'E-Wallet',
      'mbanking_bri' => 'M-Banking (BRI)',
      'mbanking_bni' => 'M-Banking (BNI)',
      'mbanking_bca' => 'M-Banking (BCA)',
      'mbanking_mandiri' => 'M-Banking (Mandiri)',
      'mbanking' => 'M-Banking',
      'qris' => 'QRIS',
      'cod' => 'COD (Bayar di Tempat)',
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

