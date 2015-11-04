<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('status_id')->nullable();
            $table->unsignedInteger('manager_id')->nullable();
            $table->string('name')->unique();
            $table->string('legal_name')->defaults('');
            $table->string('address')->defaults('');
            $table->string('contact_person')->defaults('');
            $table->string('person_position')->defaults('');
            $table->string('phone')->defaults('');
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('customer_categories')
                  ->onDelete('set null');

            $table->foreign('status_id')
                  ->references('id')
                  ->on('customer_statuses')
                  ->onDelete('set null');

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
        Schema::drop('customers');
    }
}
