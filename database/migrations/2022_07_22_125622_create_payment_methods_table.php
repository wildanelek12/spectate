<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('channel_code');
            $table->string('name');
            $table->enum('rate', ['nominal', 'percentage'])->default('nominal');
            $table->double('fee', 11, 2);
            $table->enum('category', ['virtual_account', 'retail_outlet', 'e-wallet'])->nullable();
            $table->boolean('is_visible')->default(0);
            $table->longText('image_path')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
