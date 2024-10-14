<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return view('dashboard.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id|integer',
            'name'        => 'required|unique:subcategories',
            'description' => 'nullable'
        ]);

        Subcategory::create($request->all());

        return redirect()->back()
        ->with('success', "The category \"" . $request['name'] . "\" has been created successfully.");
    }

    // Method (2): by the name only
    public function show($name)
    {
        $subcategory = Subcategory::where('name', $name)->firstOrFail();
        return view('dashboard.subcategories.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(auth()->user()->role == "admin"){
            $subcategory = Subcategory::findOrFail($id);
            return view('dashboard.subcategories.edit', compact('subcategory'));
        }
        return redirect()->route('subcategories.index')
        ->with('unauthorized_action_edit', 'Sorry, you are unauthorized to do this action as a moderator!');;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id|integer',
            'name'        => 'required|unique:subcategories,name,' . $id,
            'description' => 'nullable'
        ]);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($request->all());

        return redirect()->back()
        ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('dashboard.subcategories.index')
        ->with('success', 'Category deleted successfully.');
    }

    // softDelete

    // trash (Trash/Recycle Bin) [view/blade]
    public function trash(){
        $subcategories = Subcategory::onlyTrashed()->latest()->get();
        $subcategories_count = $subcategories->count();
        return view('dashboard.subcategories.trash', compact('subcategories', 'subcategories_count'));
    }

    // restore (from trash.blade.php) [action]
    public function restore(string $id){
        if(auth()->user()->role != "moderator"){
            $subcategory = Subcategory::withTrashed()->find($id);
            $subcategory->restore();
            return redirect()->back()
            ->with('success', "Category \"$subcategory->name\" has been restored successfully.");
        }
        return redirect()->back()
        ->with('unauthorized_action_restore', 'Sorry, you are unauthorized to do this action as a moderator!');
    }

    // forceDelete (from trash.blade.php) [action]
    public function forceDelete(string $id){
        $subcategory = Subcategory::where('id', $id);
        $subcategory->forceDelete();
        return redirect()->back()
        ->with('success', "Category has been permanently deleted successfully.");
    }

}
