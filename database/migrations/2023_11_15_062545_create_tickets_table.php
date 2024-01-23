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
		Schema::create('tickets', function (Blueprint $table) {
			$table->id();

			$table->string('title', 50);
			$table->text('description', 1000);
			$table->json('file_paths')->nullable();

			$table->enum('status', ['open', 'closed'])->default('open');
			$table->enum('priority', ['low', 'medium', 'high'])->default('low');

			$table->unsignedBigInteger('agent_id')->nullable();
			$table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');

			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('tickets');
	}
};
