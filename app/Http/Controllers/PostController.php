<?php

namespace App\Http\Controllers;

use App\Exceptions\PostException;
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

    public function detailPost($id): \Illuminate\Http\JsonResponse
    {
        $data = $this->postRepository->getPostById($id);

        return $this->successResponse($data);
    }

    public function updatePost(ApiPostRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $post = $this->postRepository->getPostById($id);
        if (!$post) {
            throw new PostException(__('message.post_not_found'), 400);
        }
        $data = $this->postRepository->update($request, $post);

        return $this->successResponse($data);
    }

    public function deletePost($id): \Illuminate\Http\JsonResponse
    {
        $post = $this->postRepository->getPostById($id);
        if (!$post) {
            throw new PostException(__('message.post_not_found'), 400);
        }
        $data = $this->postRepository->deletePost($id);

        return $this->successResponse($data);
    }
}
