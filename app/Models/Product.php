<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use HasUuids;
    use HasSlug;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'price',
        'category_id',
        'okei_id',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage('ru');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function okei(): BelongsTo
    {
        return $this->belongsTo(Okei::class);
    }
}
