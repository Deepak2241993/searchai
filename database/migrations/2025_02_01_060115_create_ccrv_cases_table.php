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
        Schema::create('ccrv_cases', function (Blueprint $table) {
            $table->id();
            $table->string('request_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status')->nullable();
            $table->string('code')->nullable();
            $table->string('message')->nullable();
            $table->string('ccrv_status')->nullable();
            
            // Case information
            $table->string('case_number')->nullable();
            $table->string('case_category')->nullable();
            $table->string('case_type')->nullable();
            $table->string('case_status')->nullable();
            $table->year('case_year')->nullable();
            $table->string('cnr')->nullable();
            $table->string('district_name')->nullable();
            $table->string('filing_date')->nullable();
            $table->string('filing_number')->nullable();
            $table->year('filing_year')->nullable();
            $table->string('first_hearing_date')->nullable();
            $table->string('decision_date')->nullable();
            $table->string('court_name')->nullable();
            $table->string('oparty')->nullable();
            $table->string('police_station')->nullable();
            $table->text('under_acts')->nullable();
            $table->text('under_sections')->nullable();
            $table->string('nature_of_disposal')->nullable();
            $table->string('name')->nullable();
            $table->string('father_match_type')->nullable();
            $table->string('name_match_type')->nullable();
            $table->string('algorithm_risk')->nullable();
            $table->string('state_name')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ccrv_cases');
    }
};
