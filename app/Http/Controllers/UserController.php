<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('role', 'ASC')->get();
        return view('backend.users.index', compact('data'));
    }

    public function add()
    {
        return view('backend.users.add');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        try {
            $data = User::create([
                'name'          => $request->name,
                'role'          => $request->role,
                'email'         => $request->email,
                'password'      => Hash::make($request->password)
            ]);

            return redirect('user')->with([
                'success' => 'Insert data success!'
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => "Error : " . $error->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('backend.users.edit', compact('data'));
    }

    public function update(Request $request)
    {
    
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $user = User::find($request->id);
            $data = $user->update([
                'name'      => $request->name,
                'role'      => $request->role,
                'password'  => $request->password ? Hash::make($request->password) : $user->password
            ]);
            return redirect('user')->with([
                'success' => 'Update data success!'
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => "Error : " . $error->getMessage()
            ]);
        }
    }

    public function delete($id)
    {

        try {
            $data = User::find($id)->delete();
            return redirect('user')->with([
                'success' => 'Delete data success!'
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => "Error : " . $error->getMessage()
            ]);
        }
    }
}