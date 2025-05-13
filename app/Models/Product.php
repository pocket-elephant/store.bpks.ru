<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use HasUuids;
    use HasSlug;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'price',
        'supplier_data',
        'supplier_id',
        'category_id',
        'stock',
        'okei_id',
        'processed',
    ];

    protected $casts = [
        'price' => 'float',
        'supplier_data' => 'array',
        'processed' => 'boolean',
        'stock' => 'integer',
    ];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    #[SearchUsingFullText(['name'])]
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
        ];
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

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function url(): Attribute
    {
        return Attribute::get(function () {
           return route('products.show', [
               'product' => $this,
           ]);
        });
    }
}
