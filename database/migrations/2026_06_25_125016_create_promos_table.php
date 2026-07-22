<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('badge')->nullable(); // "NEW", "HOT", "TERBATAS"
            $table->string('badge_color', 20)->default('#E85D04');
            $table->string('discount_text')->nullable(); // "Diskon 30%"
            $table->string('image')->nullable();
            $table->string('cta_text')->default('Pesan Sekarang');
            $table->string('cta_url')->default('/pesan');
            $table->date('valid_until')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
