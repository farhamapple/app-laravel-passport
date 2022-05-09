<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = 5;
        $posts = Post::where('user_id', $userId)->get();

        if ($posts) {
            # code...
            return PostResource::collection($posts);
        }

        return response()->json('No Post found for You');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->user_id = $this->_userId();
        $post->title = $request->title;
        $post->detail = $request->detail;

        if ($post->save()) {
            # code...
            return PostResource::collection($post);
        }

        return response()->json('Post Not Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post) {
            # code...
            return new PostResource($post);
        }

        return response()->json('No Post Found for you');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = $this->_post($id);

        if ($post) {
            # code...
            $post->title = $request->title;
            $post->detail = $request->detail;
            $post->save();

            return new PostResource($post);
        }

        return response()->json('No Post Found for you');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = $this->_post($id);

        if ($post) {
            # code...
            $post->delete();

            return new PostResource($post);
        }

        return response()->json('No Post Found for you');

    }

    protected function _userId(){
        return 10;
    }

    protected function _post($id){
        $userId = $this->_userId();
        $post = Post::where('user_id', $userId)->where('id', $id)->first();

        return $post;
    }
}
