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
        Schema::table('ccrv_cases', function (Blueprint $table) {
            
            $table->string('registration_number')->nullable();
            $table->string('registration_year')->nullable();
            $table->string('source')->nullable();
            $table->string('type')->nullable();
            $table->string('case_decision_date')->nullable();
            $table->string('registration_date')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ccrv_cases', function (Blueprint $table) {
            //
        });
    }
};
