<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personal_certificates', function (Blueprint $table) {
            $table->unsignedBigInteger('registration_id')->nullable()->after('id');
            $table->foreign('registration_id')->references('id')->on('certification_registrations')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('personal_certificates', function (Blueprint $table) {
            $table->dropForeign(['registration_id']);
            $table->dropColumn('registration_id');
        });
    }
};
