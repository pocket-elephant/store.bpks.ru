<?php

namespace App\Models;

use App\Enums\OrderState;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'client',
        'delivery',
    ];

    protected $casts = [
        'state' => OrderState::class,
        'client' => 'array',
        'delivery' => 'array',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function total(): Attribute
    {
        return Attribute::get(fn() => $this->items->sum('total'));
    }

    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(Application::class)
            ->withTimestamps()
            ->withPivot([
                'external_id',
            ]);
    }
}
