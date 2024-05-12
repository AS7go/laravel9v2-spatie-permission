<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('add-new-post');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();

        return view('dashboard', compact([
            'posts'
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'text'=>'required|string',

        ]);

        Post::create($request->all());

        return redirect()->back()->with('status', 'Post added!');
        
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('edit-new-post', compact([
            'post'
        ]));
    }

    public function update(Post $post, Request $request)
    {
        // return view('edit-new-post', compact([
        //     'post'
        // ]));
    }
}
