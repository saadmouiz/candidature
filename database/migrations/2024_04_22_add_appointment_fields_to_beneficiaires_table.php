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
        Schema::table('beneficiaires', function (Blueprint $table) {
            $table->timestamp('appointment_date')->nullable();
            $table->boolean('has_appointment')->default(false);
            $table->timestamp('appointment_sent_at')->nullable();
            $table->boolean('attendance_confirmed')->default(false);
            $table->timestamp('attendance_confirmed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beneficiaires', function (Blueprint $table) {
            $table->dropColumn([
                'appointment_date',
                'has_appointment',
                'appointment_sent_at',
                'attendance_confirmed',
                'attendance_confirmed_at'
            ]);
        });
    }
}; 