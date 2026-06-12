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
        Schema::create('certification_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('association');
            $table->string('firm_name');
            $table->string('district');
            $table->text('address');
            $table->string('proprietor');
            $table->string('mobile_primary');
            $table->string('contact2_name')->nullable();
            $table->string('mobile_secondary')->nullable();
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('portal')->nullable();
            $table->string('companies_dealt_with');
            $table->json('services_offered');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certification_registrations');
    }
};
