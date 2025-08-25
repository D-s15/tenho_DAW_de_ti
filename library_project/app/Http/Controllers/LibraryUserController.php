<?php

namespace App\Http\Controllers;

use Eloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'username'            => 'required|string|max:255',
            'password'        => 'required|string|min:8|confirmed',
            'phone'          => 'nullable|string|max:15',
        ]);

        $validated = array_merge($validated, [
            'password'  => bcrypt($request->password), // Encriptar a password
            'user_type' => 'reader',
            'phone'    => '+351 ' . $request->phone
        ]);

        $lib_user =Lib_User::create($validated);

       return redirect()->route('home')->with('success', 'Registo efetuado com sucesso!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username'    => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('library')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/')->with('success', 'Login efetuado com sucesso!');
        }


        return back()->withErrors([
            'username' => 'As credenciais não correspondem aos nossos registos.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('library')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Sessão terminada.');
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
