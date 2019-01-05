<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {

            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['errors' => 'user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }

        return response()->json(compact('token'));
    }

    public function check_token()
    {
        try {
            $user = $this->jwt->parseToken()->authenticate();
            $data['user'] = $user;
            $data['status'] = true;

            return response()->json($data);

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            $result['error'] = 'token expired';
            $result['status'] = false;

            return response()->json($result, 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            $result['error'] = 'token invalid';
            $result['status'] = false;

            return response()->json($result, 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            $result['error'] = 'token not present';
            $result['status'] = false;

            return response()->json($result, 500);
        }
    }

    public function logout(Request $request)
    {
        $this->jwt->parseToken()->invalidate();

        return ['message'=>'token removed'] ;
    }
}
