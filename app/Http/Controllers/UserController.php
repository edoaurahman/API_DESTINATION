<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = 'user';
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'message' => 'User created successfully',
        ],200);
    }

    //login post
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            if (Hash::check($credentials['password'], $user->password)) {
                //string random
                $token = md5(time());
                $user->login_token = $token;
                $user->save();
                return response()->json([
                    'user' => $user,
                    'message' => 'Login Success',
                    'token' => $token
                ],200);
            } else {
                return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
        }
    }

    // logout
    public function logout(Request $request)
    {
        $user = User::where('login_token', $request->login_token)->first();

        if ($user) {
            $user->login_token = null;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Logged out successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'Logged out failed']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
