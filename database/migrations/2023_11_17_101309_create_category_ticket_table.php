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
		Schema::create('category_ticket', function (Blueprint $table) {
			$table->id();

			$table->unsignedBigInteger('category_id');
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

			$table->unsignedBigInteger('ticket_id');
			$table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('category_ticket');
	}
};
