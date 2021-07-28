<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userManagment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        Auth::attempt($request->only('email','password'));

        $token = $request->user()->createToken('token',['member'])->plainTextToken;

        return response()->json([
            'login' => 'success',
            'token' => $token
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|unique:users|email',
            'name'  => 'required|min:3',
            'password' => 'required|min:3'
        ]);

        User::create([
            'email' => $request->email,
            'name'  => $request->name,
            'password' => Hash::make($request->password)
        ]);
        Auth::attempt($request->only('email','password'));
        //sactum token creation command csrf -> loged in 
        $token = $request->user()->createToken('token',['member'])->plainTextToken;

        return response()->json([
            'register' => 'success',
            'token'    => $token
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }

    public function delete(Request $request)
    {
        Auth::user()->tokens()->delete();
        
        return ['loged out'];
    }
}
