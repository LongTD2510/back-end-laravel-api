<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class AuthRepository.
 */
class AuthRepository extends BaseRepository implements AuthInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @param $request
     * @return mixed
     * @throws \JsonException
     */
    public function createToken($request)
    {
        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();
        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $request["email"],
            'password' => $request["password"],
            'scope' => '',
        ];
        $requestResult = Request::create('/oauth/token', 'POST', $data);

        return json_decode(app()->handle($requestResult)->getContent(), false, 512, JSON_THROW_ON_ERROR);
    }


    /**
     * @param $request
     * @return mixed
     */
    public function refreshToken($request)
    {
        // TODO: Implement refreshToken() method.
        return DB::transaction(function() use($request){
            $client = DB::table('oauth_clients')
                ->where('password_client', true)
                ->first();

            $data = [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->refresh_token,
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'scope' => ''
            ];
            $request = Request::create('/oauth/token', 'POST', $data);
            $content = json_decode(app()->handle($request)->getContent());

            return $res = ([
                'token' => $content->access_token,
                'refresh_token' => $content->refresh_token,
                'expires_at' => $content->expires_in,
                'type' => 'Bearer'
            ]);
        },5);
    }

    /**
     * @param $user
     * @param $token
     * @return mixed
     */
    public function returnWithToken($user, $token)
    {
        $user['token_type'] = $token->token_type;
        $user['access_token'] = $token->access_token;
        $user['refresh_token'] = $token->refresh_token;
        $user['expires_at'] = $token->expires_in;

        return $user;
    }
}
