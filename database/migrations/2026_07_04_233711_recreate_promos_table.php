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
        Schema::dropIfExists('promos');
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->enum('platform', ['GoFood', 'GrabFood', 'ShopeeFood']);
            $table->string('title');
            $table->string('discount_value')->nullable();
            $table->text('terms')->nullable();
            $table->date('valid_until')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
