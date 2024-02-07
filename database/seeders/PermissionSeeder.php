<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Permission::create(['name' => 'view-dashboard'])->syncRoles(['admin']);

		Permission::create(['name' => 'view-users'])->syncRoles(['admin']);
		Permission::create(['name' => 'create-users'])->syncRoles(['admin']);
		Permission::create(['name' => 'edit-users'])->syncRoles(['admin']);
		Permission::create(['name' => 'delete-users'])->syncRoles(['admin']);

		Permission::create(['name' => 'view-tickets'])->syncRoles(['admin', 'agent', 'user']);
		Permission::create(['name' => 'create-tickets'])->syncRoles(['admin', 'user']);
		Permission::create(['name' => 'edit-tickets'])->syncRoles(['admin', 'agent']);
		Permission::create(['name' => 'delete-tickets'])->syncRoles(['admin']);

		Permission::create(['name' => 'view-categories'])->syncRoles(['admin']);
		Permission::create(['name' => 'create-categories'])->syncRoles(['admin']);
		Permission::create(['name' => 'edit-categories'])->syncRoles(['admin']);
		Permission::create(['name' => 'delete-categories'])->syncRoles(['admin']);

		Permission::create(['name' => 'view-labels'])->syncRoles(['admin']);
		Permission::create(['name' => 'create-labels'])->syncRoles(['admin']);
		Permission::create(['name' => 'edit-labels'])->syncRoles(['admin']);
		Permission::create(['name' => 'delete-labels'])->syncRoles(['admin']);
	}
}
