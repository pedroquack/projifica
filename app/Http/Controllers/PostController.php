<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function user_index($name, $id)
    {
        $user = User::find($id);
        return view('post.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','min:8','max:96'],
            'body' => ['required','min:64','max:5000'],
            'image' => ['nullable','mimes:png,jpg,jpeg,webp'],
            'user_id' => ['required'],
        ]);

        $post = new Post();

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/posts/';
            $file->move($path, $filename);
            $post->image = $path.$filename;
        }
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->save();
        return redirect()->route('post.show',$post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
