<?php
<<<<<<< HEAD

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
=======
namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
>>>>>>> main

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('dashboard.users.indexes.all-users-index', compact('users'));
    }

    public function customersIndex()
    {
<<<<<<< HEAD
        $customers       = User::where('role', 'customer')->paginate(3);
=======
        $customers       = User::where('user_type', 'customer')->paginate(3);
>>>>>>> main
        $customers_count = $customers->count();
        return view('dashboard.users.indexes.customers-index', compact('customers', 'customers_count'));
    }

    public function moderatorsIndex()
    {
<<<<<<< HEAD
        $moderators = User::where('role', 'moderator')->get();
=======
        $moderators = User::where('user_type', 'moderator')->get();
>>>>>>> main
        $moderators_count = $moderators->count();
        return view('dashboard.users.indexes.moderators-index', compact('moderators', 'moderators_count'));
    }

    public function adminsIndex()
    {
<<<<<<< HEAD
        $admins = User::where('role', 'admin')->get();
=======
        $admins = User::where('user_type', 'admin')->get();
>>>>>>> main
        $admins_count = $admins->count();
        return view('dashboard.users.indexes.admins-index', compact('admins', 'admins_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
<<<<<<< HEAD

        $request->validate([
            'username' => 'required|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'birth_date' => 'nullable|date',
            'bio' => 'nullable|string',
            'role' => 'required|in:admin,mod,orginizer,participant',
            'id_card_no' => 'nullable|integer',
        ]);

        User::create($request->all());
        return redirect()->back()
            ->with('success', "The user \"" . $request['username'] . "\" has been created successfully.");
    }

    //by the username only
    public function show(string $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('dashboard.users.show', compact('user'));
    }
=======
        $rules = [
            'username'  => 'required|unique:users',
            'email'     => 'required|email|unique:users',
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => 'required',
        ];

        if(auth()->user()->user_type === "admin"){
            $rules['user_type'] .= '|in:customer,moderator,admin';
        } elseif(auth()->user()->user_type === "moderator"){
            $rules['user_type'] .= '|in:customer';
        } else{
            return abort(403);
        }

        $request->validate($rules);

        $request->merge([
            // 'password' => Hash::make($request->input('username') . '_123456789'),
            'password' => Hash::make($request->username . '_123456789'),

        ]);

        User::create($request->all());

        return redirect()->back()
        ->with('success', "The user \"" . $request['username'] . "\" has been created successfully.");
    }

    /**
     * Display the specified resource.
     */

    // Method (1): by id as a required parameter (Also we can get the other columns as a required or optional parameter(s))
        // public function show($id)
        // {
        //     $user = User::findOrFail($id);
        //     return view('dashboard.users.show', compact('user'));
        // }

    // Method (2): by the username only
        public function show(string $username)
        {
            $user = User::where('username', $username)->firstOrFail();
            return view('dashboard.users.show', compact('user'));
        }
>>>>>>> main

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
<<<<<<< HEAD
        if (auth()->user()->id == $user->id || (auth()->user()->role == "admin" && $user->role != "admin")) {
            return view('dashboard.users.edit', compact('user'));
        } elseif (auth()->user()->role == "admin" && $user->role == "admin" && auth()->user()->id != $user->id) {
            return redirect()->back()
                ->with('unauthorized_action', "You are unauthorized to modify/delete user(s).");
        } else {
=======
        if(auth()->user()->id == $user->id || (auth()->user()->user_type == "admin" && $user->user_type != "admin")){
            return view('dashboard.users.edit', compact('user'));
        } elseif(auth()->user()->user_type == "admin" && $user->user_type == "admin" && auth()->user()->id != $user->id){
            return redirect()->back()
            ->with('unauthorized_action', "You are unauthorized to modify/delete user(s).");
        } else{
>>>>>>> main
            return redirect()->route('users.edit', auth()->user()->id);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
<<<<<<< HEAD
        $request->validate([
            'username' => 'required|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'birth_date' => 'nullable|date',
            'bio' => 'nullable|string',
            'role' => 'required|in:admin,mod,orginizer,participant',
            'id_card_no' => 'nullable|integer',
        ]);
            $user->update($request->only(
                'first_name', 'last_name', 'email', 'birth_date', 'bio', 'role', 'id_card_no'
            ));
    }
=======

        $rules = [
            'username'  => 'required|unique:users,username,' . $user->id,
            'email'     => 'required|email|unique:users,email,' . $user->id,
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => 'required',
        ];

        if(auth()->user()->user_type === "admin"){
            if(auth()->user()->id == $user->id){
                $rules['user_type'] .= '|in:admin';
            } else{
                $rules['user_type'] .= '|in:customer,moderator,admin';
            }
        } elseif(auth()->user()->user_type === "moderator"){
            $rules['user_type'] .= '|in:moderator';
        } else{
            return abort(403);
        }

        $request->validate($rules);

        if($request->has('password')){
            $request->merge([
                // 'password' => Hash::make($request->input('username') . '_123456789'),
                'password' => Hash::make($request->username . '_123456789'),
            ]);
        }

        $user->update($request->all());

        return redirect()->back()
        ->with('success', "The user \"" . $request['username'] . "\" has been updated successfully.");
    }

>>>>>>> main
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
<<<<<<< HEAD
        if (auth()->user()->role == "admin" && $user->role != "admin" && auth()->user()->id != $user->id) {
            $user->delete();
            return redirect()->route('users.index')
                ->with('success', "User \"$user->username\" has been deleted successfully.");
        }
        return redirect()->back()
            ->with('unauthorized_action', "You are unauthorized to modify/delete user(s).");
=======
        if(auth()->user()->user_type == "admin" && $user->user_type != "admin" && auth()->user()->id != $user->id){
            $user->delete();
            return redirect()->route('users.index')
            ->with('success', "User \"$user->username\" has been deleted successfully.");
        }
        return redirect()->back()
        ->with('unauthorized_action', "You are unauthorized to modify/delete user(s).");
>>>>>>> main
    }
}
