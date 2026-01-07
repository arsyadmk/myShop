<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();

        // dd($stores);

        return view('store.index', ['stores' => $stores]);
    }

    public function manage(Store $store)
    {
        return view('store.manage', compact('store'));
    }

    public function detail(Store $store)
    {
        // dd($store->id);
        $users = $store->users; // Retrieves all users where client_id = $store->id

        return view('store.detail', compact('client', 'users'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $store = Store::create($validatedData);

        $storeEmailName = Str::lower(Str::slug($store->name, ''));

        $validatedUserAdmin['name'] = "admin " . $store->name;
        $validatedUserAdmin['email'] = "admin@" . $storeEmailName . ".com";
        $validatedUserAdmin['password'] = bcrypt('12345678');
        $validatedUserAdmin['role'] = 1;
        $validatedUserAdmin['store_id'] = $store->id;

        $validatedUserCashier['name'] = "cashier " . $store->name;
        $validatedUserCashier['email'] = "cashier@" . $storeEmailName . ".com";
        $validatedUserCashier['password'] = bcrypt('12345678');
        $validatedUserCashier['role'] = 2;
        $validatedUserCashier['store_id'] = $store->id;

        $user_admin = User::create($validatedUserAdmin);
        $user_cashier = User::create($validatedUserCashier);

        return redirect()->route('store.index')->with('success', 'Store created successfully!');
    }

    public function update(Request $request)
    {
        $store = Store::findOrFail($request->id);
        $validatedData = $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        try {
            // $store = Store::where('id', $store->id)->update($validatedData);
            $store->update($validatedData);
            return redirect()->route('store.index')->with('success', 'Store edited successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function delete(Store $store)
    {
        try {
            $store->delete(); //softdelete
            $store->users()->delete(); // This soft-deletes users

            return redirect()->route('store.index')->with('success', 'Store deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
