<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Http\Requests\StoreTicketsRequest;
use App\Http\Requests\UpdateTicketsRequest;
use Inertia\Inertia;

class TicketsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return Inertia::render('Tickets/Index');
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
	public function store(StoreTicketsRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Tickets $tickets)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Tickets $tickets)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateTicketsRequest $request, Tickets $tickets)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Tickets $tickets)
	{
		//
	}
}
