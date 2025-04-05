<?php

namespace App\Http\Controllers\API;

use App\Models\Integration;
use App\Models\User;
use App\Services\IntegrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 1;
        $user = User::create($input);
        $success['user'] = $user;

        return $this->sendResponse($success, 'Tạo tài khoản thành công.');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return $this->sendError('Không thể xác minh.', ['error' => 'Không thể xác minh']);
        }

        $success = $this->respondWithToken($token);
        $integration = Integration::where('platform', 'shopee')->where('user_id', Auth::id())->first();

        if ($integration) {
            app(IntegrationService::class)->refreshTokenIfNeeded($integration);
        }

        return $this->sendResponse($success, 'Đăng nhập thành công.');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $success = Auth::user();

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return $this->sendResponse([], 'Đăng xuất thành công.');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $success = $this->respondWithToken(Auth::refresh());

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    /**
     * Get the token array structure.
     *
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ];
    }
}
