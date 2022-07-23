<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('buyers');
            $table->string('invoice_number');
            $table->double('amount', 11, 2);
            $table->double('fee', 11, 2);
            $table->double('admin_fee', 11, 2);
            $table->double('total', 11, 2);
            $table->string('payment_method')->nullable();
            $table->string('snap_token')->nullable();
            $table->enum('status', ['UNPAID', 'PENDING', 'PAID', 'DONE']);
            $table->timestamp('paid_at')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
