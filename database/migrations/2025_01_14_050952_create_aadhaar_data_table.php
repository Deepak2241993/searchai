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
        Schema::create('aadhaar_data', function (Blueprint $table) {
            $table->id();
            $table->string('aadhaar_number')->nullable();
            $table->string('reference_id')->unique();
            $table->string('id_token')->nullable();
            $table->string('aadhaar_token')->nullable();
            $table->string('name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER'])->nullable();;
            $table->string('mobile')->nullable();
            $table->string('care_of')->nullable();
            $table->string('house')->nullable();
            $table->string('street')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('landmark')->nullable();
            $table->string('post_office_name')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('country')->default('India');
            $table->string('vtc_name')->nullable();
            $table->longText('photo_base64')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aadhaar_data');
    }
};
