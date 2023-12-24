<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {

        //$users = \App\Models\User::paginate(10);
        $users = DB::table('users')
        -> when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%'.$name.'%');
        })
        -> orderBy('id', 'desc')
        -> paginate(10);
        return view('pages.user.index', compact('users'));
    }

    public function create() {
        return view('pages.user.create');
    }

    public function store(StoreUserRequest $request) {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        \App\Models\User::create($data);
        return redirect()->route('user.index')->with('success', 'User successfully created');
    }

    public function edit($id) {
        $user = \App\Models\User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user) {
        $data = $request->validated();
        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User successfully updated');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User successfully deleted');
    }
}
