<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name_client', 255);
            $table->string('cpf');
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2);
            $table->decimal('fee_amount', 15, 2);
            $table->decimal('percent_tax', 15, 2);
            $table->timestamp('paid_at')->nullable();
            $table->integer('payment_status_id')->index()->unsigned()->default(1);
            $table->string('payment_method_slug', 30)->index();
            $table->bigInteger('merchant_id')->index()->unsigned();
            $table->foreign('payment_status_id')->references('id')->on('payment_status');
            $table->foreign('payment_method_slug')->references('slug')->on('payment_methods');
            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments');
	}
};
