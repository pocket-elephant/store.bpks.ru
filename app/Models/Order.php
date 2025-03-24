<?php

namespace App\Models;

use App\Enums\OrderState;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    use HasUuids;

    protected $attributes = [
        'state' => OrderState::Created,
    ];

    protected $fillable = [
        'uuid',
        'session_id',
        'state',
    ];

    protected $casts = [
        'state' => OrderState::class,
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}
