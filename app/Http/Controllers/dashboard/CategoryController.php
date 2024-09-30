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
        $request->validate([
            'name'        => 'required|unique:categories',
            'description' => 'nullable'
        ]);

        Category::create($request->all());

        return redirect()->back()
        ->with('success', "The category \"" . $request['name'] . "\" has been created successfully.");
    }

    /**
     * Display the specified resource.
     */

    // Method (1): by id as a required parameter (Also we can get the other columns as a required or optional parameter(s))
        // public function show($id)
        // {
        //     $category = Category::findOrFail($id);
        //     return view('dashboard.categories.show', compact('category'));
        // }

    // Method (2): by the name only
        public function show($name)
        {
            $category = Category::where('name', $name)->firstOrFail();
            return view('dashboard.categories.show', compact('category'));
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(auth()->user()->user_type == "admin"){
            $category = Category::findOrFail($id);
            return view('dashboard.categories.edit', compact('category'));
        }
        return redirect()->route('categories.index')
        ->with('unauthorized_action_edit', 'Sorry, you are unauthorized to do this action as a moderator!');;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'        => 'required|unique:categories,name,' . $id,
            'description' => 'nullable'
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->back()
        ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')
        ->with('success', 'Category deleted successfully.');
    }

    // softDelete
        // trash (Trash/Recycle Bin) [view/blade]
        public function trash(){
            $categories = Category::onlyTrashed()->latest()->get();
            $categories_count = $categories->count();
            return view('dashboard.categories.trash', compact('categories', 'categories_count'));
        }

        // restore (from trash.blade.php) [action]
        public function restore(string $id){
            if(auth()->user()->user_type != "moderator"){
                $category = Category::withTrashed()->find($id);
                $category->restore();
                return redirect()->back()
                ->with('success', "Category \"$category->name\" has been restored successfully.");
            }
            return redirect()->back()
            ->with('unauthorized_action_restore', 'Sorry, you are unauthorized to do this action as a moderator!');
        }

        // forceDelete (from trash.blade.php) [action]
        public function forceDelete(string $id){
            $category = Category::where('id', $id);
            $category->forceDelete();
            return redirect()->back()
            ->with('success', "Category has been permanently deleted successfully.");
        }

}
