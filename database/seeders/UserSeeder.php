<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		User::create([
			'name' => 'Admin',
			'email' => 'admin@admin.com',
			'email_verified_at' => now(),
			'password' => Hash::make('password'),
			'remember_token' => Str::random(10),
		])->assignRole('admin');

		User::create([
			'name' => 'Agent',
			'email' => 'agent@agent.com',
			'email_verified_at' => now(),
			'password' => Hash::make('password'),
			'remember_token' => Str::random(10),
		])->assignRole('agent');

		User::create([
			'name' => 'Another Agent',
			'email' => 'another@agent.com',
			'email_verified_at' => now(),
			'password' => Hash::make('password'),
			'remember_token' => Str::random(10),
		])->assignRole('agent');

		User::create([
			'name' => 'User',
			'email' => 'user@user.com',
			'email_verified_at' => now(),
			'password' => Hash::make('password'),
			'remember_token' => Str::random(10),
		])->assignRole('user');
	}
}
