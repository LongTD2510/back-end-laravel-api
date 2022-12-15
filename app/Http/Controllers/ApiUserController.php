<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Repositories\Auth\AuthInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{
    /**
     * @var UserInterface
     */
    private UserInterface $userRepository;
    /**
     * @var AuthInterface
     */
    private AuthInterface $authRepository;

    /**
     * ApiUserController constructor.
     * @param UserInterface $userRepository
     * @param AuthInterface $authRepository
     */
    public function __construct(UserInterface $userRepository, AuthInterface $authRepository)
    {
        $this->userRepository = $userRepository;
        $this->authRepository = $authRepository;
    }

    public function register(ApiRegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->userRepository->createUser($request);

        return $this->successResponse($data);
    }

    public function login(ApiLoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return $this->errorResponse('Unauthorized', 401);
        }
        $token = $this->authRepository->createToken($credentials);
        $data = $this->authRepository->returnWithToken(Auth::user(), $token);

        return $this->successResponse($data, 'Successfully login');
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        $logout = $request->user()->token()->revoke();
        return $this->successResponse($logout, 'Successfully logged out');
    }

    public function refreshToken(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->authRepository->refreshToken($request);
        
        return $this->successResponse($data, 'Refresh token is expiry');
    }

    public function userInfo(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->successResponse($request->user('api'));
    }

}
