<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $fillable = [
        'name', 'slug', 'address', 'city', 'phone', 'whatsapp',
        'open_hours', 'is_open_now', 'maps_embed', 'lat', 'lng', 'image', 'is_active'
    ];

    protected $casts = [
        'is_open_now' => 'boolean',
        'is_active'   => 'boolean',
        'lat'         => 'float',
        'lng'         => 'float',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getWhatsappUrlAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->whatsapp ?? $this->phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        return 'https://wa.me/' . $phone;
    }

    public function getIsOpenNowAttribute($value): bool
    {
        if (!$this->open_hours) {
            return (bool) $value;
        }

        $times = preg_split('/[-–]/', $this->open_hours);
        if (count($times) === 2) {
            $start = trim($times[0]);
            $end = trim($times[1]);
            
            try {
                $currentTime = now()->setTimezone('Asia/Jakarta')->format('H:i');
                
                if ($end < $start) {
                    return $currentTime >= $start || $currentTime <= $end;
                }
                
                return $currentTime >= $start && $currentTime <= $end;
            } catch (\Exception $e) {
                return (bool) $value;
            }
        }
        
        return (bool) $value;
    }
}
