<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('homepage_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('homepage_section_id')->constrained()->onDelete('cascade');
            $table->string('heading');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->integer('order_num')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_cards');
    }
};
