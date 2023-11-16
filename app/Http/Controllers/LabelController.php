<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use Inertia\Inertia;

class LabelController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return Inertia::render('Labels/Index');
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
	public function store(StoreLabelRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Label $label)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Label $label)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateLabelRequest $request, Label $label)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Label $label)
	{
		//
	}
}
