<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Label;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;

class LabelController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$labels = Label::query()
			->when(Request::input('search'), fn ($query, $search) => $query->where('title', 'like', '%' . $search . '%'))
			->orderBy('created_at', 'desc')
			->paginate(10)
			->withQueryString();

		return Inertia::render('Labels/Index', [
			'labels' => $labels,
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
	public function store(StoreLabelRequest $request)
	{
		$label = new Label();
		$label->title = $request->get('title');
		$label->visible = $request->get('visible');
		$label->slug = Str::slug($request->get('title'));
		$label->user_id = auth()->user()->id;

		$label->save();

		return redirect()->back()->with('message', 'Label created successfully');
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

		return redirect()->back()->with('message', 'Label updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Label $label)
	{
		$label->delete();

		return redirect()->back()->with('message', 'Label deleted successfully');
	}
}
