<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
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
        return view('tag.index')->with('tag', Tag::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('ass');
        return view('tag.create');
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
            'name' => 'required|unique:tags|max:255',


        ]);


        Tag::create([
            'name' => $request->name

        ]);

        Session::flash('msg', 'Tag successfully added');
        return redirect()->back();
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
    public function edit(Tag $tag)
    {
        return view('tag.create')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Tag::find($id)->update(['name' => $request->name]);
        Session::flash('msg', 'Tag successfully updated');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {


        if ($tag->post->count() > 0) {
            Session::flash('error', 'Tag cannot be deleted because it is associated with post');

            return redirect()->back();
        }
        $tag->withTrashed()->find($tag->id);

        if ($tag->trashed()) {
            $tag->forceDelete();
            Session::flash('msg', 'Tag trashed successfully');
        } else {

            $tag->delete();
            Session::flash('msg', 'Tag deleted successfully');
        }
        return redirect()->back();
    }

    public function trashed()
    {

        $tags = Tag::onlyTrashed()->orderBy('name')->paginate(5);

        return view('tag.index')->with('tag', $tags);
    }


    public function restore($id)
    {

        Tag::withTrashed()->find($id)->restore();
        Session::flash('msg', 'Tag successfully restored');
        return redirect()->back();
    }
}
