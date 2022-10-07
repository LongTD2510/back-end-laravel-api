<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class PostRepository.
 */
class PostRepository extends BaseRepository implements PostInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Post::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        return DB::transaction(static function () use ($request) {
            $post = new Post();
            $post->fill($request->all());
            $post->save();
            $post->refresh();

            return $post;
        }, 5);

    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deletePost($id)
    {
        // TODO: Implement deletePost() method.
    }

    /**
     * @return mixed
     */
    public function list()
    {
        return Post::latest()->paginate(2);
    }
}
