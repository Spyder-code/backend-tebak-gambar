<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $user->api_token = Str::random(60);
            $user->save();
            return $user;
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(60)
        ]);

        return response($user);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function logout()
    {
        if (auth()->user()) {
            $user = auth()->user();
            $user->api_token = null; // clear api token
            $user->save();

            return response()->json([
                'message' => 'Thank you for using our application',
            ]);
        }

        return response()->json([
            'error' => 'Unable to logout user',
            'code' => 401,
        ], 401);
    }

    public function updateProfile(Request $request)
    {
        $name = $request->name;
        $id = Auth::id();

        User::find($id)->update([
            'name' => $name
        ]);

        $user = User::find($id);
        return $user;
    }

    public function updatePassword(Request $request)
    {
        $current = $request->current_password;
        $new = $request->new_password;
        $password = Auth::user()->password;
        if(Hash::check($current, $password)){
            User::find(Auth::id())
            ->update([
            'password' => Hash::make($new)
            ]);
            return "Password berhasil diubah";
        } else {
            return "Password salah";
        }
    }
}
