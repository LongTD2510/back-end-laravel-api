<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiPostRequest;
use App\Repositories\Post\PostInterface;

class PostController extends Controller
{
    //
    /**
     * @var PostInterface
     */
    private PostInterface $postRepository;

    /**
     * PostController constructor.
     * @param PostInterface $postRepository
     */
    public function __construct(PostInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function createPost(ApiPostRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->postRepository->store($request);
        return $this->successResponse($data);
    }

    public function listPost(): \Illuminate\Http\JsonResponse
    {
        $data = $this->postRepository->list();
        return $this->successResponse($data);
    }
}
