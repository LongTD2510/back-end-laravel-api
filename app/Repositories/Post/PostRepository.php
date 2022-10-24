<?php

namespace App\Repositories\Post;

use App\Consts;
use App\Models\Post;
use Carbon\Carbon;
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
            $post->end_at = Carbon::now()->addDay(Consts::ADD_30_DAY);
            $post->save();
            $post->refresh();

            return $post;
        }, 5);

    }

    /**
     * @param $request
     * @param $post
     * @return mixed
     */
    public function update($request, $post)
    {
        return DB::transaction(static function () use ($request, $post) {
            $post->title = $request->title;
            $post->user_id = $request->user_id;
            $post->content = $request->content;
            $post->save();
            $post->refresh();
            return $post;
        }, 5);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deletePost($id)
    {
        // TODO: Implement deletePost() method.
        return DB::transaction(static function () use ($id) {
            return Post::where('id', $id)->delete();
        }, 5);
    }

    /**
     * @return mixed
     */
    public function list()
    {
        return Post::latest()
            ->with('createdBy')->where('end_at', '>', Carbon::now())
            ->paginate(4);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPostById($id)
    {
        return Post::with('createdBy')->where('id', $id)
            ->orderByDesc('id')->first();
    }
}
