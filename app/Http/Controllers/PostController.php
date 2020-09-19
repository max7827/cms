<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;

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
        return view('post.index')->with('post', Post::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('ass');
        return view('post.create')->with('category', Category::all())->with('tag', Tag::all());
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
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'published_at' => $request->published_at,
            'image' => $image,
            'tag_id' => $request->tag
        ]);

        if ($request->tag) {
            $post->tag()->attach($request->tag);
        }

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
        return view('post.create')->with('post', $post)->with('category', Category::all())->with('tag', Tag::all());
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
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|image'

        ]);


        $a = Post::where('id', '!=', $post->id)->get('title');
        foreach ($a as $b) {
            $c[] = $b->title;
        }

        if (in_array($request->title, $c) == true) {
            Session::flash('error', 'title already exists');
            return redirect()->back()->withInput();
        }
        //dd('aaa00');

        Storage::delete($post->image);
        $image = $request->image->store('post');
        Post::find($post->id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'published_at' => $request->published_at,
            'image' => $image
        ]);

        if ($request->tag) {
            $post->tag()->sync($request->tag);
        }

        Session::flash('msg', 'post successfully updated');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->withTrashed()->find($post->id);
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

        $posts = Post::onlyTrashed()->orderBy('title')->paginate(5);

        return view('post.index')->with('post', $posts);
    }

    public function restore($id)
    {

        Post::withTrashed()->find($id)->restore();
        Session::flash('msg', 'post successfully restored');
        return redirect()->back();
    }
}
