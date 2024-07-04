<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\{Post, Comment};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($sluggable = null)
    { 
        $postList = Post::with('postedby');
        if($sluggable){
            $postList = $postList->where("category_id", $sluggable);
        }
        $postList= $postList->orderBy("created_at","desc")->paginate(10);
        return view('index')->with(['postList'=> $postList]);
    }
    public function show($sluggable = null){
        $categoryList = Category::get();
        $post = Post::with('postedby')->where('slug', $sluggable)->first();
        $commentList = Comment::with('commentedby')->where('post_id', $post['id'])->orderBy('id', 'desc')->get();
        return view('post.show')->with(['post'=> $post, 'categoryList'=> $categoryList, 'commentList'=> $commentList]);
    }
}
