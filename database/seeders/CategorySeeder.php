<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$users = User::all();

		foreach ($users as $user) {
			$randomNumber = random_int(1, 20);

			Category::factory($randomNumber)->create([
				'user_id' => $user->id,
			]);
		}
	}
}
