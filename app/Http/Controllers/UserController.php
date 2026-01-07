<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // $users = User::latest()->get(); //dengan order by
        // $users = Post::with('author')->latest()->get(); //dengan order by & eager loading

        // echo jenis_user(1);

        // return view('admin.user.index');
        return view('user.index', ['users' => $users]);
    }

    public function manage(User $user)
    {
        // dd($user->id);

        // if($user->id){

        // } else {

        // }
        $stores = Store::all()->pluck('name', 'id'); // or ->pluck('name', 'id') if you want just the values
        return view('user.manage', compact('stores', 'user'));
    }

    public function process_add_edit(Request $request)
    {
        //nanti dipakai kalau untuk update, ngambil variabel sebelumnya untuk validasi inputan terutama email saat edit suatu user
        $user = User::findOrFail($request->id);
        // dd($user->id);
        // dd($request->jenis);
        $validatedData = $request->validate([
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // 'email' => 'required',
            // 'username' => 'required',
            'password' => 'required',
            'role' => 'required',
            'store_id' => 'required',
        ]);

        // Hash the password before saving (if not using the booted() in model)
        $validatedData['password'] = bcrypt($validatedData['password']);

        // dd($request);
        // User::create($validatedData);

        $user = User::create($validatedData);
        // return response()->json([
        //     'message' => 'User created successfully',
        //     'user' => $user
        // ], 201);
        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
            'store_id' => 'required',
        ]);

        // Hash the password before saving (if not using the booted() in model)
        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        // dd($user->username);
        // if (!empty($request->password)) {
        //     'password' => '',
        // }
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable',
            'role' => 'required',
            'store_id' => 'required',
        ]);

        // Hash the password before saving
        if (!empty($request->password)) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user = User::where('id', $user->id)->update($validatedData);
        return redirect()->route('user.index')->with('success', 'User edited successfully!');
    }
    public function delete(User $user)
    {
        $user->delete(); //softdelete

        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }
}
