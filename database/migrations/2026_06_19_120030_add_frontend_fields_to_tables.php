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
        Schema::table('events', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
            $table->text('description')->nullable()->after('category');
        });

        Schema::table('downloads', function (Blueprint $table) {
            $table->string('category')->nullable()->after('title');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->string('category')->nullable()->after('title');
        });

        Schema::table('member_categories', function (Blueprint $table) {
            $table->text('description')->nullable()->after('annual_fee');
            $table->json('features')->nullable()->after('description');
            $table->boolean('is_popular')->default(false)->after('features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['category', 'description']);
        });

        Schema::table('downloads', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('member_categories', function (Blueprint $table) {
            $table->dropColumn(['description', 'features', 'is_popular']);
        });
    }
};
