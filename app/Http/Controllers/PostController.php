<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $posts = Post::orderBy('created_at','DESC')->paginate(10);
        return view('post.index', compact('posts'));
    }

    public function oldest(){
        $posts = Post::orderBy('created_at')->paginate(10);
        return view('post.index', compact('posts'));
    }

    public function more_comments(){
        $posts = Post::withCount('comments')->orderBy('comments_count', 'DESC')->paginate(10);
        return view('post.index', compact('posts'));
    }

    public function less_comments(){
        $posts = Post::withCount('comments')->orderBy('comments_count')->paginate(10);
        return view('post.index', compact('posts'));
    }

    public function user_index($id)
    {
        $user = User::find($id);
        return view('post.user_index', compact('user'));
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
            'title' => ['required', 'min:8', 'max:96'],
            'body' => ['required', 'min:64', 'max:5000'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg,webp'],
            'user_id' => ['required'],
        ]);

        $post = new Post();

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/posts/';
            $file->move($path, $filename);
            $post->image = $path . $filename;
        }
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->save();
        return redirect()->route('post.show', $post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::find($id);
        Gate::authorize('update',$post);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        Gate::authorize('update',$post);

        $request->validate([
            'title' => ['required', 'min:8', 'max:96'],
            'body' => ['required', 'min:64', 'max:5000'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg,webp'],
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/posts/';
            $file->move($path, $filename);
            $post->image = $path . $filename;
        }
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return redirect()->route('post.show', $post->id)->with('message','Postagem atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        Gate::authorize('destroy',$post);
        $post->delete();
        return redirect()->intended()->with('message','Postagem excluida com sucesso!');
    }
}
