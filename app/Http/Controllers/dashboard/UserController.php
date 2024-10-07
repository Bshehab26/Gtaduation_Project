<?php
namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $customers       = User::where('user_type', 'customer')->paginate(3);
        $customers_count = $customers->count();
        return view('dashboard.users.indexes.customers-index', compact('customers', 'customers_count'));
    }

    public function moderatorsIndex()
    {
        $moderators = User::where('user_type', 'moderator')->get();
        $moderators_count = $moderators->count();
        return view('dashboard.users.indexes.moderators-index', compact('moderators', 'moderators_count'));
    }

    public function adminsIndex()
    {
        $admins = User::where('user_type', 'admin')->get();
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        if(auth()->user()->id == $user->id || (auth()->user()->user_type == "admin" && $user->user_type != "admin")){
            return view('dashboard.users.edit', compact('user'));
        } elseif(auth()->user()->user_type == "admin" && $user->user_type == "admin" && auth()->user()->id != $user->id){
            return redirect()->back()
            ->with('unauthorized_action', "You are unauthorized to modify/delete user(s).");
        } else{
            return redirect()->route('users.edit', auth()->user()->id);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if(auth()->user()->user_type == "admin" && $user->user_type != "admin" && auth()->user()->id != $user->id){
            $user->delete();
            return redirect()->route('users.index')
            ->with('success', "User \"$user->username\" has been deleted successfully.");
        }
        return redirect()->back()
        ->with('unauthorized_action', "You are unauthorized to modify/delete user(s).");
    }
}
