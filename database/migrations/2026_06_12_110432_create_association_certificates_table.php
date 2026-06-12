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
        Schema::create('association_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('cert_id')->unique();
            $table->string('association_name');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('association_certificates');
    }
};
