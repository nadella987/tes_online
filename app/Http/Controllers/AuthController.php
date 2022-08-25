<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$credentials = $request->only('username', 'password');

    	try {
    		if (! $token = JWTAuth::attempt($credentials)){
    			return response()->json(['eror' => 'unauthorized'],401);
    		}
    	} catch (JWTException $e) {
    		return response()->json(['message' => 'Generate token failed']);
    	}

    	//return response()->json(['token' => $token]);

        // $data = [
        //         'token' => $token,
        //         'user' => JWTAuth::user()
        //     ];
        $user = JWTAuth::user();
            return response()->json([
                'success' => true,
                'message' => 'login success',
                'token' => $token,
                'user' => $user
            ]);
    }

    public function logincheck()
        {
            try{
                if(! $user = JWTAuth::parseToken()->authenticate()){
                    return response()->json(['message' => 'Invalid Token']);
                }
            }catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json(['message' => 'Token Expired']);
            }catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json(['message' => 'Invalid Token']);
            }catch(Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json(['message' => 'Token absent']);
            }
            return response()->json(['message' => 'authentication success']);
        }

    public function logout(Request $request)
    {
        if(JWTAuth::invalidate(JWTAuth::getToken())) {
            return response()->json(['message' => 'anda sudah logout']);
        }else{
            return response()->json(['message' => 'gagal logout']);
        }
    }
        
}
