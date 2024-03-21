<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use App\Models\User;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\Category;

use App\Http\Resources\LabelResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserAgentResource;

use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$user = Auth::user();
		$role = $user->getRoleNames()->first();

		$ticketsQuery = Ticket::query()
			->with('categories:id,title', 'labels:id,title', 'agent:id,name') // Eager load relationships
			->when(Request::input('search'), fn ($query, $search) => $query->where('title', 'like', '%' . $search . '%'))
			->orderBy('created_at', 'desc');

		if ($role === 'user') {
			// User gets tickets created by themselves
			$ticketsQuery->where('user_id', $user->id);
		} elseif ($role == 'agent') {
			// Agent gets tickets assigned to them
			$ticketsQuery->where('agent_id', $user->id);
		}

		$tickets = $ticketsQuery->paginate(10)->withQueryString();

		$categories = Category::orderBy('title', 'desc')->get();
		$categories = CategoryResource::collection($categories);

		$labels = Label::orderBy('title', 'desc')->get();
		$labels = LabelResource::collection($labels);

		$agents = User::role('agent')->get();
		$agents = UserAgentResource::collection($agents);

		return Inertia::render('Tickets/Index', [
			'tickets' => $tickets,
			'labels' => $labels,
			'agents' => $agents,
			'categories' => $categories,
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
	public function store(StoreTicketRequest $request)
	{
		$user = auth()->user();

		$ticket = new Ticket([
			'title' => $request->input('title'),
			'description' => $request->input('description'),
			// 'file_paths' => $request->input('file_paths'),
			'status' => $request->input('status'),
			'priority' => $request->input('priority'),
		]);

		$user->tickets()->save($ticket);

		if ($request->filled('agent_id')) {
			$agent = User::findOrFail($request->input('agent_id'));

			$ticket->assignAgent($agent);
		}

		$ticket->labels()->attach($request->input('labels'));
		$ticket->categories()->attach($request->input('categories'));

		return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Ticket $ticket)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Ticket $ticket)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateTicketRequest $request, Ticket $ticket)
	{
		$this->authorize('update', $ticket);

		$ticket->update([
			'title' => $request->input('title'),
			'description' => $request->input('description'),
			'status' => $request->input('status'),
			'priority' => $request->input('priority'),
		]);

		if ($request->filled('agent_id')) {
			$agent = User::findOrFail($request->input('agent_id'));
			$ticket->assignAgent($agent);
		} else {
			$ticket->removeAgent();
		}

		// Sync categories and labels
		$ticket->categories()->sync($request->input('categories', []));
		$ticket->labels()->sync($request->input('labels', []));

		return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Ticket $ticket)
	{
		$this->authorize('delete', $ticket);

		$ticket->delete();

		return redirect()->back()->with('success', 'Ticket deleted successfully');
	}
}
