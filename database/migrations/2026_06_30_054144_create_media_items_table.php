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
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'coverage' or 'press_release'
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('outlet')->nullable(); // e.g. "The Tribune"
            $table->string('icon')->nullable(); // e.g. "📰"
            $table->date('published_date');
            $table->string('url')->nullable();
            $table->string('file_path')->nullable(); // For press releases
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_items');
    }
};
