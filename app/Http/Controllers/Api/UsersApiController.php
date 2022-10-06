<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        return User::create([
            'name' => request('name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);
    }

    public function getSingleUser(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        request()->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        $success = $user->update([
            'name' => request('name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
        ]);

        return [
            'success' => $success
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $success = $user->delete();

        return [
            'success' => $success
        ];
    }
}