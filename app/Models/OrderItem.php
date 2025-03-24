<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'quantity',
        'product_id',
        'order_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
