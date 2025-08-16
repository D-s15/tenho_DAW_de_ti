<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Eloquent;
use App\Models\LibraryUser as Lib_User;

class LibraryUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'email'             => 'required|string|unique:library_users,email',
            'name'            => 'required|string|max:255',
            'password'        => 'required|string|min:8|confirmed',
            'phone'          => 'nullable|string|max:15',
        ])->merge([
            'password' => bcrypt($request->password), // Encrypt the password
        ]) + ['user_type' => 'reader'];

        #dd($validated);
        $lib_user =Lib_User::create($validated);

        return response()->json($lib_user, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
