<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'ingredients',
        'price', 'price_original', 'image', 'is_featured', 'is_available',
        'is_new', 'is_bestseller', 'calories', 'sort_order'
    ];

    protected $casts = [
        'price'          => 'float',
        'price_original' => 'float',
        'is_featured'    => 'boolean',
        'is_available'   => 'boolean',
        'is_new'         => 'boolean',
        'is_bestseller'  => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedPriceOriginalAttribute(): ?string
    {
        if (!$this->price_original) return null;
        return 'Rp ' . number_format($this->price_original, 0, ',', '.');
    }

    public function getDiscountPercentAttribute(): ?int
    {
        if (!$this->price_original || $this->price_original <= $this->price) return null;
        return (int) round((($this->price_original - $this->price) / $this->price_original) * 100);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return 'https://picsum.photos/seed/donut-' . $this->id . '/400/400';
    }
}
