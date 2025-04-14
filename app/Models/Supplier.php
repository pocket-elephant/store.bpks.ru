<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'key',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}
