<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Repositories\Room\RoomInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    //
    /**
     * @var RoomInterface
     */
    private RoomInterface $roomRepository;

    public function __construct(RoomInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function listRoomChat(Request $request): \Illuminate\Http\JsonResponse
    {
        $params = $request->all();
        $data = $this->roomRepository->list($params);

        return $this->successResponse($data);
    }

    public function createRoomChat(RoomRequest $RoomRequest): \Illuminate\Http\JsonResponse
    {
        $userId = Auth::id();
        $data = $this->roomRepository->store($RoomRequest, $userId);

        return $this->successResponse($data);
    }

    public function filterRoomChat(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->roomRepository->filterRoom($request);

        return $this->successResponse($data);
    }
}
