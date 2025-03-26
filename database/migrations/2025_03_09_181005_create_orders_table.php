<?php

use App\Enums\OrderState;
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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->uuid();

            $table->string('state')
                ->default(OrderState::Created)
                ->nullable();

            $table->string('session_id')
                ->index();

            $table->jsonb('client')
                ->nullable();

            $table->jsonb('delivery')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
