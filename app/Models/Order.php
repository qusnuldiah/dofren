<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'branch_id', 'customer_name', 'customer_phone',
        'customer_email', 'order_type', 'delivery_address', 'notes',
        'subtotal', 'delivery_fee', 'total_price', 'status', 'payment_method'
    ];

    protected $casts = [
        'subtotal'      => 'float',
        'delivery_fee'  => 'float',
        'total_price'   => 'float',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber(): string
    {
        $prefix = 'DF-' . date('Y') . '-';
        $last = static::where('order_number', 'like', $prefix . '%')->latest()->first();
        $next = $last ? (int) substr($last->order_number, -4) + 1 : 1;
        return $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'Menunggu Konfirmasi',
            'confirmed'  => 'Dikonfirmasi',
            'processing' => 'Sedang Diproses',
            'ready'      => 'Siap Diambil',
            'delivered'  => 'Selesai',
            'cancelled'  => 'Dibatalkan',
            default      => $this->status,
        };
    }
}
