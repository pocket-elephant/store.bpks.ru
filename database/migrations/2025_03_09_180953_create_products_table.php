<?php

use App\Models\Category;
use App\Models\Okei;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->uuid();

            $table->string('name')
                ->fulltext();

            $table->jsonb('supplier_data')
                ->nullable();

            $table->foreignIdFor(Okei::class);

            $table->float('price')
                ->nullable();

            $table->string('slug')
                ->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
