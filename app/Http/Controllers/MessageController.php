<?php

namespace App\Http\Controllers;

use App\Repositories\Message\MessageInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //
    /**
     * @var MessageInterface
     */
    private MessageInterface $messageInterface;

    /**
     * MessageController constructor.
     * @param MessageInterface $messageInterface
     */
    public function __construct(MessageInterface $messageInterface)
    {
        $this->messageInterface = $messageInterface;
    }

    public function messages(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->messageInterface->messages();

        return $this->successResponse($data);
    }

    public function addMessages(Request $request): \Illuminate\Http\JsonResponse
    {
        $userId = Auth::id();
        $data = $this->messageInterface->addMessages($request, $userId);

        return $this->successResponse($data);
    }
}
