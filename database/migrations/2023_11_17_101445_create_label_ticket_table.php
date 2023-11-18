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
		Schema::create('label_ticket', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('label_id');
			$table->unsignedBigInteger('ticket_id');
			$table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
			$table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('label_ticket');
	}
};
