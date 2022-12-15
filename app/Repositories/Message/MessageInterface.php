<?php


namespace App\Repositories\Message;


interface MessageInterface
{
    public function addMessages($request, $userId);

    public function messages();
}
