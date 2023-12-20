<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$admin = Role::create(['name' => 'admin']);
		$agent = Role::create(['name' => 'agent']);
		$user = Role::create(['name' => 'user']);

		/*
		Regular users: manage THEIR tickets
		After registration/login, user sees the only menu item "Tickets" with a table of tickets only created by themselves.
		Table of tickets needs to have dropdown filters: by status, priority and category.
		They can add a new ticket, but can't edit/delete tickets.
		They can click the ticket title in the table to open the page to see more details and ticket activity log and comments,
		also may add a comment there (more on that later).
    */

		Permission::create(['name' => 'view users'])->syncRoles([$admin]);
		Permission::create(['name' => 'create users'])->syncRoles([$admin]);
		Permission::create(['name' => 'edit users'])->syncRoles([$admin]);
		Permission::create(['name' => 'delete users'])->syncRoles([$admin]);

		Permission::create(['name' => 'view tickets'])->syncRoles([$admin]);
		Permission::create(['name' => 'create tickets'])->syncRoles([$admin]);
		Permission::create(['name' => 'edit tickets'])->syncRoles([$admin]);
		Permission::create(['name' => 'delete tickets'])->syncRoles([$admin]);

		Permission::create(['name' => 'view labels'])->syncRoles([$admin]);
		Permission::create(['name' => 'create labels'])->syncRoles([$admin]);
		Permission::create(['name' => 'edit labels'])->syncRoles([$admin]);
		Permission::create(['name' => 'delete labels'])->syncRoles([$admin]);

		Permission::create(['name' => 'view categories'])->syncRoles([$admin]);
		Permission::create(['name' => 'create categories'])->syncRoles([$admin]);
		Permission::create(['name' => 'edit categories'])->syncRoles([$admin]);
		Permission::create(['name' => 'delete categories'])->syncRoles([$admin]);
	}
}
