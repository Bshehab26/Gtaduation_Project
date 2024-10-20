<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\{
    Hash,
    Auth,
};

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        if (auth()->user()->id == $user->id) {
            return view('users.edit', compact('user'));
        } else {
            return redirect()->back()
                ->with('unauthorized_action', "You are unauthorized to modify/delete user(s).");
        }
    }




    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'username'  => 'required|unique:users,username,' . $user->id,
            'first_name' => 'required|string|max:255'       . $user->id,
            'last_name' => 'required|string|max:255'       . $user->id,
            'email'     => 'required|email|unique:users,email,' . $user->id,
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'role' => 'required',
        ];

        // if (auth()->user()->role === "admin") {
        //     if (auth()->user()->id == $user->id) {
        //         $rules['role'] .= '|in:admin';
        //     } else {
        //         $rules['role'] .= '|in:customer,organizer,moderator,admin';
        //     }
        // } elseif (auth()->user()->role === "moderator") {
        //     $rules['role'] .= '|in:moderator';
        // } else {
        //     return abort(403);
        // }

        $request->validate($rules);

        if ($request->has('password')) {
            $request->merge([
                // 'password' => Hash::make($request->input('username') . '_123456789'),
                'password' => Hash::make($request->username . '_123456789'),
                'role'=>auth()->user()->role,
            ]);
        }

        $user->update($request->all());

        return redirect()->back()->with('success', "The user \"" . $request['username'] . "\" has been updated successfully.");
    }


}
