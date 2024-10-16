<?php

namespace App\Http\Controllers\dashboard;
use Illuminate\Support\Facades\Storage;

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
          "venue_img" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // 2MB max file size
          "phone"=> "required|unique:venues",
          "city"=> "required",
          "address"=> "required",
          "capacity"=> "required|integer"
        ]);
        // Handle the uploaded file
        if ($request->hasFile('venue_img')){

            // Get the file from the request
            $file=$request->file('venue_img');

            // Generate a unique file name
            $filename = time() . '_' . $file->getClientOriginalName();

            // Save the file to a directory (e.g., 'public/photos')
            $path = $file->storeAs('photos', $filename, 'public');

            // Add the photo path to the request data
            $request->merge(['venue_image' => $path]);
        }
        Venue::create($request->except('venue_img'));

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
        if(auth()->user()->role == "admin"){
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
//    public function update(Request $request, string $id)
//    {
        public function update(Request $request, Venue $venue)
    {
        // Validate the request, optionally validate the venue_img only if uploaded
        $request->validate([
            "name" => "required",
            "venue_img" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // Optional, only validate if a new image is uploaded
            "phone" => "required|unique:venues,phone," . $venue->id,  // Exclude current venue's phone from uniqueness check
            "city" => "required",
            "address" => "required",
            "capacity" => "required|integer"
        ]);

        // Check if a new image is uploaded
        if ($request->hasFile('venue_img')) {
            // Get the new image file
            $file = $request->file('venue_img');

            // Generate a unique file name
            $filename = time() . '_' . $file->getClientOriginalName();

            // Save the file to a directory (e.g., 'public/photos')
            $path = $file->storeAs('photos', $filename, 'public');

            // Add the new file path to the request data under 'venue_image'
            $request->merge(['venue_image' => $path]);

            // Optionally delete the old image file from storage if you want to clean up
            if ($venue->venue_image) {
                Storage::delete('public/' . $venue->venue_image);
            }
        }

        // Update the venue record in the database
        $venue->update($request->except('venue_img')); // Exclude 'venue_img' as it’s not a database column

        // Redirect back with a success message
        return redirect()->back()->with('success', 'The venue "' . $venue->name . '" has been updated successfully.');
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
