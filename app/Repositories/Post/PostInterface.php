<?php


namespace App\Repositories\Post;


interface PostInterface
{
    public function store($request);

    public function update($id);

    public function list();

    public function deletePost($id);
}
