<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{
    use ApiResponser;

    public function login(Request $request)
    {

        $http = new \GuzzleHttp\Client;
        try {

                $response = $http->post(config('services.passport.login_endpoint'), [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => config('services.passport.client_id'),
                        'client_secret' => config('services.passport.client_secret'),
                        'username' => $request->username,
                        'password' => $request->password,
                    ]
                ]);

                return $this->successResponse(json_decode((string)$response->getBody(),true),200);

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {

            if ($e->getCode() === 400) {
                return $this->errorResponse('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return $this->errorResponse('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return $this->errorResponse('Something went wrong on the server.', $e->getCode());
        }
    }

    public function refresh(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'refresh_token' => $request->refresh_token
                ]
            ]);

            return $this->successResponse(json_decode((string)$response->getBody(),true),200);

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {

            //return response()->json([$e->getMessage()]);
            if ($e->getCode() === 400) {
                return $this->errorResponse('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                 return $this->errorResponse(
                    'The refresh token is invalid. Please try again', $e->getCode());
            }
            return $this->errorResponse(
                'Something went wrong on the server.', $e->getCode());
        }
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return $this->successResponse('Logged out successfully', 200);
    }


}
