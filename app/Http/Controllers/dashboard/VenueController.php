<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

use App\Models\Venue;
use Illuminate\Http\Request;


class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venues=Venue::get();
        return view("dashboard.venues.index",compact("venues"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view("dashboard.venues.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
          "name"=> "required",
          "phone"=> "required|unique:venues",
          "city"=> "required",
          "address"=> "required",
          "capacity"=> "required|integer"
        ]);

        Venue::create($request->all());

        return redirect()->back()
        ->with('success', "The venue \"" . $request['name'] . "\" has been created successfully.");
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $venue=Venue::findOrFail($id);
       return view("dashboard.venues.show",compact("venue"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(auth()->user()->user_type == "admin"){
          $venue=Venue::findOrFail($id);
          return view("dashboard.venues.edit",compact("venue"));
        }
        return redirect()->route('venues.index')
        ->with('unauthorized_action_edit', 
        'Sorry, you are unauthorized to do this action as a moderator!');;
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name"=> "required",
            "phone"=> 'required|unique:venues,phone,'.$id,
            "city"=> "required",
            "address"=> "required",
            "capacity"=> "required|integer"
          ]);

          $venue=Venue::findOrFail($id);
          $venue->update($request->all());

          return redirect()->back()
          ->with('success', "The venue \"" . $request['name'] . "\" Updated successfully.");
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $venue=Venue::findOrFail($id);
        $venue->delete();

        return redirect()->route('venues.index')
        ->with('success', "The venue deleted successfully.");
  
    }
}
