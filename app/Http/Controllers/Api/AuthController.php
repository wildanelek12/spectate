<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'         => 'required|email',
            'password'      => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        try {
            Auth::attempt([
                'email'     => $request->email,
                'password'  => $request->password
            ]);

            if (!Auth::check()) {
                return $this->sendError('email atau password salah');
            }

            $user = Auth::user();
            $token = $user->createToken('Bearer Token')->accessToken;
        } catch (\Exception $e) {
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('login berhasil', [
            'token' => $token,
            'user'  => $user
        ]);
    }

    public function logout()
    {
        try {
            Auth::user()->token()->revoke();
        } catch (\Exception $e) {
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('logout berhasil');
    }
}
