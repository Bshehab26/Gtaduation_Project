<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['name' => 'required|unique:categories', 'description' => 'nullable']
        );
        Category::create($request->all());
        return redirect()->back()
            ->with('success', "The category \"" . $request['name'] . "\" has been created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required|unique:categories,name,' . $id,
                'description' => 'nullable',
            ]
        );

        if (empty($request['description']))
            $request['description'] = 'it is a product of our company';
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->back()
            ->with('success', "The category \"" . $request['name'] . "\" has been updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()
            ->with('success', "The category has been deleted successfully.");
    }
     /**
     * Remove All resource from storage.
     */
    public function destroyAll()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $category->delete();
        }
        return redirect()->back()
            ->with('success', "All categories has been deleted successfully.");
    }
}
