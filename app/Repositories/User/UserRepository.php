<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository implements UserInterface
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
     */
    public function createUser($request)
    {
        return DB::transaction(static function () use($request){
            $user = new User();
            $user->fill($request->all());
            $user->password = Hash::make($request->password);
            $user->save();
            $user->refresh();

            return $user;
        },5);
    }
}
