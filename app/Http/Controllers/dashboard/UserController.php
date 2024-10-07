<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

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
        $customers       = User::where('role', 'customer')->paginate(3);
        $customers_count = $customers->count();
        return view('dashboard.users.indexes.customers-index', compact('customers', 'customers_count'));
    }

    public function moderatorsIndex()
    {
        $moderators = User::where('role', 'moderator')->get();
        $moderators_count = $moderators->count();
        return view('dashboard.users.indexes.moderators-index', compact('moderators', 'moderators_count'));
    }

    public function adminsIndex()
    {
        $admins = User::where('role', 'admin')->get();
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        if (auth()->user()->id == $user->id || (auth()->user()->role == "admin" && $user->role != "admin")) {
            return view('dashboard.users.edit', compact('user'));
        } elseif (auth()->user()->role == "admin" && $user->role == "admin" && auth()->user()->id != $user->id) {
            return redirect()->back()
                ->with('unauthorized_action', "You are unauthorized to modify/delete user(s).");
        } else {
            return redirect()->route('users.edit', auth()->user()->id);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
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
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if (auth()->user()->role == "admin" && $user->role != "admin" && auth()->user()->id != $user->id) {
            $user->delete();
            return redirect()->route('users.index')
                ->with('success', "User \"$user->username\" has been deleted successfully.");
        }
        return redirect()->back()
            ->with('unauthorized_action', "You are unauthorized to modify/delete user(s).");
    }
}
