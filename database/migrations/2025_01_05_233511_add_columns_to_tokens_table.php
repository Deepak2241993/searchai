<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tokens', function (Blueprint $table) {
            // Add the columns you need
            $table->unsignedBigInteger('user_id')->after('id');
            $table->string('service_type')->after('user_id')->nullable();
            $table->string('token')->unique()->after('service_type')->nullable();
            $table->timestamp('expires_at')->nullable()->after('token');
            $table->enum('status', ['active', 'expired'])->default('active')->after('expires_at');
        });
    }

    public function down()
    {
        Schema::table('tokens', function (Blueprint $table) {
            // Rollback the columns if necessary
            $table->dropColumn(['user_id', 'service_type', 'token', 'expires_at', 'status']);
        });
    }
};
