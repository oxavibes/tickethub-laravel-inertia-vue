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
			$table->unsignedBigInteger('assigned_user_id')->nullable(); // Foreign key to users table
			$table->foreign('assigned_user_id')->references('id')->on('users');
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
