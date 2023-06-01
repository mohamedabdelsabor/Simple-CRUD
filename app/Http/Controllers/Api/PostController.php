<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Requests\storepostrequest;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::paginate(5);
   
        return PostResource::collection($posts);
    }

    public function show($postId)
    {
        $post = Post::find($postId);

        return new PostResource($post);
    }
    public function store(storepostrequest $request)
    {
        $requestdata = request()->all();
        $post = post::create($requestdata);
        return new PostResource($post);
    }
}