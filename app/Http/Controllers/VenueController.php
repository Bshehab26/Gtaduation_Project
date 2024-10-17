<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venues = Venue::get();
        return view('venue.index', compact('venues'));
    }


    // public function crea(string $id){

    // }
       public function show(string $id)
    {

           $venue=Venue::findOrFail($id);
           return view("venue.show",compact("venue"));

    }

    
    public function searchVenues(Request $request)
    {
        $search = $request->search;
    
        $venues = Venue::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('city', 'LIKE', '%' . $search . '%');
    
        if (is_numeric($search)) {
            $venues = $venues->orWhere('capacity', '>=', $search);
        }
    
        $venues = $venues->get();
    
        return view('venue.index', compact('venues'));
    }
    

}