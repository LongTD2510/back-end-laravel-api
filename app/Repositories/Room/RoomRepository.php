<?php

namespace App\Repositories\Room;

use App\Models\ChatRoom;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class RoomRepository.
 */
class RoomRepository extends BaseRepository implements RoomInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
        return ChatRoom::class;
    }

    /**
     * @param $request
     * @param $userId
     * @return mixed
     */
    public function store($request, $userId)
    {
        // TODO: Implement store() method.
        return DB::transaction(static function () use ($request, $userId) {
            $room = new ChatRoom();
            $room->name = $request->name;
            $room->description = $request->description;
            $room->created_by = $userId;
            $room->save();
            $room->refresh();

            return $room;
        }, 5);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function list($request)
    {
        // TODO: Implement list() method.
        return ChatRoom::with('userCreated')
            ->when(!empty($request['search']), function ($q) use ($request) {
                $q->where('name', 'LIKE', escapeSpecialChar(trim($request['search'], " ")));
            })
            ->latest()
            ->paginate(5);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function filterRoom($request)
    {
        // TODO: Implement filterRoom() method.
        return ChatRoom::with('userCreated')
            ->when(!empty($request['search']), function ($q) use ($request) {
                $q->where('name', 'LIKE', escapeSpecialChar(trim($request['search'], " ")));
            })
            ->latest()
            ->get();
    }
}
