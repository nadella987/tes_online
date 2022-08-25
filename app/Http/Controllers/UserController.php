<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;



class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'name' => 'required',
            'address' => 'required',
    

        ]);

        if($validator->fails()) {
            return Response()->json($validator->errors());

        }

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->postcode = $request->postcode;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->save();
        return response()->json(['message' => 'Berhasil Registrasi User']);
    }

    public function read()
    {
        return User::all();
    }

    public function show(request $request, $id)
    {
        $user = User::where('id', $id)->first();
        return Response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $validator= Validator::make($request->all(),[
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::where('id', '=' ,$id)->first();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return response()->json(['message' => 'Data User Berhasil update']);
        
    }

    public function destroy($id)
    {
        $hapus = User::where('id',$id)->delete();

            if($hapus) {
                return Response()->json(['status' => 1]);
            }else{
                return Response()->json(['status' => 0]);
            }
    }
}
