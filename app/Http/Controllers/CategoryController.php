<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('category.index')->with('category', Category::orderBy('name')->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'name' => 'required|unique:categories|max:255',
        ]);



        Category::create([
            'name' => $request->name
        ]);

        Session::flash('msg', "category created");


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
    }

    public function as()
    {
        return view('a');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // dd($category->id);
        return view('category.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        Category::find($category->id)->update([
            'name' => $request->name
        ]);

        Session::flash('msg', 'category updated successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the sspecified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::withTrashed()->find($id);
        // dd($category);
        if ($category->trashed()) {
            $category->forceDelete();
            Session::flash('msg', 'category successfully deleted');
        } else {

            $category->delete();
            Session::flash('msg', 'category successfully trashed');
        }
        return redirect()->back();
    }

    public function trashed()
    {

        $trashed = Category::onlyTrashed()->orderBy('name', 'desc')->paginate(5);
        // dd($trashed);
        return view('category.index')->with('category', $trashed);
    }

    public function restore($id)
    {

        Category::withTrashed()->find($id)->restore();
        Session::flash('msg', 'category successfully restored');
        return redirect()->back();
    }
}
