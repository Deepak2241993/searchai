<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the existing payments table
        Schema::dropIfExists('payments');

        // Recreate the payments table
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('payment_id')->nullable(); // primary key and auto increment
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_signature')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency')->nullable();
            $table->enum('status', ['success', 'failed', 'pending']);
            $table->timestamps();

            // Optionally, add foreign key constraints or indexes if needed
            $table->unsignedBigInteger('order_id'); // for example
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the payments table if rolling back the migration
        Schema::dropIfExists('payments');
    }
}
