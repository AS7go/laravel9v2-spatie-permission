<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('add-new-article');
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
}
