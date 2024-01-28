<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$users = User::all();

		foreach ($users as $user) {
			$randomUsersQuantity = random_int(1, 20);

			Label::factory($randomUsersQuantity)->create([
				'user_id' => $user->id,
			]);
		}
	}
}
