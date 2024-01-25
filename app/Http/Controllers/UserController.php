<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$users = User::query()
			->when(Request::input('search'), function ($query, $search) {
				$query->where(function ($query) use ($search) {
					$query->where('name', 'like', '%' . $search . '%')
						->orWhere('email', 'like', '%' . $search . '%');
				});
			})
			->with('roles:id,name')
			->orderBy('created_at', 'desc')
			->paginate(10)
			->withQueryString();

		$users->getCollection()->transform(function ($user) {
			return [
				'id' => $user->id,
				'name' => $user->name,
				'email' => $user->email,
				'created_at' => $user->created_at,
				'updated_at' => $user->updated_at,
				'roles' => $user->roles->pluck('name')->first(),
			];
		});

		return Inertia::render('Users/Index', [
			'users' => $users,
			'filters' => Request::only(['search']),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreUserRequest $request)
	{
		$user = new User();
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->password = Hash::make($request->input('password'));
		$user->save();

		$user->assignRole($request->get('role'));

		return redirect()->back()->with('message', 'User created successfully');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateUserRequest $request, User $user)
	{
		$user->name = $request->get('name');
		$user->email = $request->get('email');

		if ($request->filled('password')) {
			$user->password = Hash::make($request->input('password'));
		}

		$user->save();

		$user->syncRoles([$request->get('role')]);

		return redirect()->back()->with('message', 'User created successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(User $user)
	{
		// $user->roles()->detach();

		$user->delete();

		return redirect()->back()->with('message', 'User deleted successfully');
	}
}
