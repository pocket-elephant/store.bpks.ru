<?php

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
        Schema::create('okeis', function (Blueprint $table) {
            $table->id();

            $table->string("code")
                ->nullable()
                ->index();

            $table->string("name")
                ->nullable()
                ->index();

            $table->string("conventionalNationalView")
                ->nullable()
                ->index();

            $table->string("conventionalInternationalView")
                ->nullable()
                ->index();

            $table->string("symbolNationalView")
                ->nullable()
                ->index();

            $table->string("symbolInternationalView")
                ->nullable()
                ->index();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('okeis');
    }
};
