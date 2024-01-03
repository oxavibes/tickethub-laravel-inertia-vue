<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$categories = Category::query()
			->when(Request::input('search'), fn ($query, $search) => $query->where('title', 'like', '%' . $search . '%'))
			->orderBy('created_at', 'desc')
			->paginate(10)
			->withQueryString();

		return Inertia::render('Categories/Index', [
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
	public function store(StoreCategoryRequest $request)
	{
		$category = new Category();
		$category->title = $request->get('title');
		$category->visible = $request->get('visible');
		$category->slug = Str::slug($request->get('title'));
		$category->user_id = auth()->user()->id;

		$category->save();

		return redirect()->back()->with('message', 'Category created successfully');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Category $category)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Category $category)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCategoryRequest $request, Category $category)
	{
		$category->title = $request->get('title');
		$category->visible = $request->get('visible');
		$category->slug = Str::slug($request->get('title'));
		$category->save();

		return redirect()->back()->with('message', 'Category updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Category $category)
	{
		$category->delete();

		return redirect()->back()->with('message', 'Category deleted successfully');
	}
}
