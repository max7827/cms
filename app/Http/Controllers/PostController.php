<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('categoryRequired')->only(['create', 'store']);
    }


    public function index()
    {
        return view('post.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('ass');
        return view('post.create')->with('category', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'image' => 'required|image'

        ]);

        $image = $request->image->store('post');
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'published_at' => $request->published_at,
            'image' => $image
        ]);

        Session::flash('msg', 'post successfully added');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.create')->with('posts', $post)->with('category', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'image' => 'required|image'

        ]);
        Storage::delete($post->image);
        $image = $request->image->store('post');
        Post::find($post->id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'published_at' => $request->published_at,
            'image' => $image
        ]);

        Session::flash('msg', 'post successfully updated');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::withTrashed()->find($id);
        if ($post->trashed()) {
            $post->forceDelete();
            Storage::delete($post->image);
            Session::flash('msg', 'post trashed successfully');
        } else {

            $post->delete();
            Session::flash('msg', 'post deleted successfully');
        }
        return redirect()->back();
    }

    public function trashed()
    {

        $posts = Post::onlyTrashed()->orderBy('title')->get();

        return view('post.index')->with('posts', $posts);
    }
}
