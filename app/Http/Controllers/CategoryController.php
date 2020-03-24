<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::withCount('articles')->get();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create([
            'name' => $request->get('name')
        ]);

        return redirect()->route('admin.categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $name
     * @return View
     */
    public function edit(string $name): View
    {
        $category = Category::where('name', $name)->firstOrFail();

        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $name
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function update(string $name, CategoryRequest $request): RedirectResponse
    {
        $category = Category::where('name', $name)->firstOrFail();

        $category->name = $request->get('name');
        $category->save();

        return redirect()->route('admin.categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
