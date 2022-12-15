<?php

namespace App\Repositories\Message;

use App\Events\MessagePosted;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class MessageRepository.
 */
class MessageRepository extends BaseRepository implements MessageInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
        return Message::class;
    }

    /**
     * @param $request
     * @param $userId
     * @return mixed
     */
    public function addMessages($request, $userId)
    {
        // TODO: Implement addMessages() method.
        return DB::transaction(static function () use ($request, $userId) {
            $message = new Message();
            $message->user_id = $userId;
            $message->room_id = $request->room_id;
            $message->content = $request->content;
            $message->save();
            $message->refresh();
            broadcast(new MessagePosted($message->load('user')))->toOthers();

            return $message;
        }, 5);
    }

    /**
     * @return mixed
     */
    public function messages()
    {
        // TODO: Implement messages() method.
    }
}
