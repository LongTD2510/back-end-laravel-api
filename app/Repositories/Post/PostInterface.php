<?php


namespace App\Repositories\Post;


interface PostInterface
{
    public function store($request);

    public function update($request, $post);

    public function list();

    public function deletePost($id);

    public function getPostById($id);
}
