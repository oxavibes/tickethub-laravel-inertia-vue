<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Label;
use Illuminate\Support\Str;
use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;

class LabelController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$labels = Label::orderBy('created_at', 'desc')->paginate(10);

		return Inertia::render('Labels/Index', [
			'labels' => $labels
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
	public function store(StoreLabelRequest $request)
	{
		$label = new Label();
		$label->title = $request->get('title');
		$label->visible = $request->get('visible');
		$label->slug = Str::slug($request->get('title'));
		$label->save();

		return redirect()->back()->with('success', 'Label created successfully');
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

		$label->title = $request->get('title');
		$label->visible = $request->get('visible');
		$label->slug = Str::slug($request->get('title'));

		$label->save();

		return redirect()->back()->with('success', 'Label updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Label $label)
	{
		$label->delete();

		return redirect()->back()->with('success', 'Label deleted successfully');
	}
}
