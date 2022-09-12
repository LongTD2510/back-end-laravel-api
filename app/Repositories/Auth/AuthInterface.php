<?php


namespace App\Repositories\Auth;


interface AuthInterface
{
    public function createToken($request);
    public function refreshToken($request);
    public function returnWithToken($user, $token);
}
