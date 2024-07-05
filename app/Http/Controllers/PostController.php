<?php

namespace App\Http\Controllers;

use App\Models\{Post, Category};
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\NewPostJob;
use Illuminate\Support\Str;
use App\Events\PostPlaced;

use Auth;
use GuzzleHttp\Psr7\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // JOB TESTING
        $post = Post::first();
        // dispatch(new NewPostJob($post));

        // Trigger the event
        event(new PostPlaced($post));

        $posts = Post::with('category')->orderBy("created_at", "desc")->paginate(10);
        return view("post.index")->with(["postList" => $posts, "current_page"=> $posts->currentPage()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category =    Category::orderBy("created_at", "desc")->get();
        return view("post.create")->with(['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->category_id =   $request->category;
        $post->user_id  = auth()->id();
        $post->small_description = $request->small_description;
        $post->description = $request->description;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = auth()->id() . '_' . time() . '.' . $file->getClientOriginalName();
            $file->move(public_path('/images'), $fileName);
            $post->thumbnail = $fileName;
        }
        else{
            $post->thumbnail = null;
        }
        if ($post->save()) {
            dispatch(new NewPostJob($post));
            return redirect()->route('post.index')->with('success', 'Post created successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // return view('')->with(['post'=> $post]);
        return redirect('posts/' . $post->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->id) {
            $postData = Post::where('id', $post->id)->first();
            $category =    Category::orderBy("created_at", "desc")->get();
            return view("post.edit")->with(['category' => $category, 'postData' => $postData]);
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($post->id) {
            $post->title = $request->title;
            $post->description = $request->description;
            $post->small_description = $request->small_description;
            $post->category_id = $request->category;
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $fileName = auth()->id() . '_' . time() . '.' . $file->getClientOriginalName();
                $file->move(public_path('/images'), $fileName);
                $post->thumbnail = $fileName;
            }
            $response = $post->update();
            if ($response) {
                return redirect('post')->with('success', 'Post updated successfully');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->id) {
            $post->delete();
            return redirect('post')->with('success', 'Successfully removed');
        }
    }
}
