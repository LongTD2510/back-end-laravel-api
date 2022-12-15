<?php


namespace App\Repositories\Room;


interface RoomInterface
{
    public function store($request, $userId);

    public function list($request);

    public function filterRoom($request);
}
