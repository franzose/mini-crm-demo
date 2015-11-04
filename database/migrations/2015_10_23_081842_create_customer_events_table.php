<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type_id')->nullable();
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('manager_id')->nullable();
            $table->date('event_date')->index();
            $table->time('event_time')->index();
            $table->text('description');

            $table->foreign('type_id')
                  ->references('id')
                  ->on('customer_eventtypes')
                  ->onDelete('set null');

            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade');

            $table->foreign('manager_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_events');
    }
}
