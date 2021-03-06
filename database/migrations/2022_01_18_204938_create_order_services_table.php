<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_services', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_customer_id');
            $table->unsignedBigInteger('user_worker_id');
            $table->unsignedBigInteger('service_id');
            $table->enum('status', ['await', 'received', 'payment_expired', 'working', 'work_late', 'work_expired', 'work_completed', 'canceled','worker_received']);
            $table->string('negociation_indetify'); //?
            $table->string('payment_identify');
            $table->double('price');

            $table->timestamps();

            $table->foreign('user_customer_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('user_worker_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('service_id')
            ->references('id')
            ->on('services')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_services');
    }
}
