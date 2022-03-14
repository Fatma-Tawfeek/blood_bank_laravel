<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Post::paginate(20);
        return view('posts.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $records = Category::pluck('name', 'id');

        return view('posts.create', compact('records'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $messages = [
            'title.required' => 'Title is required',
            'category.required' => 'Category is required',
            'content.required' => 'Content is required',
            'image.required' => 'Image is required',
            'image.image' => 'Invalid file',
            'image.mimes' => 'Invalid file extension',
            'image.max' => 'Image is too big. Max size is: 2MB'
        ];

        $this->validate($request, $rules, $messages);

        $path = $request->file('image')->store('toPath', ['disk' => 'my_files']);

        $record = new Post;

        $record->title = $request->title;
        $record->category_id = $request->category;
        $record->content = $request->content;
        $record->image = $path;

        $record->save();


        flash()->success('Post has been added Successfully!');

        return redirect(route('post.index'));
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
    public function edit($id)
    {
        $record = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('posts.edit', compact('record', 'categories'));
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
        $rules = [
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $messages = [
            'title.required' => 'Title is required',
            'category.required' => 'Category is required',
            'content.required' => 'Content is required',
            'image.image' => 'Invalid file',
            'image.mimes' => 'Invalid file extension',
            'image.max' => 'Image is too big. Max size is: 2MB'
        ];

        $this->validate($request, $rules, $messages);

        $record = Post::findOrFail($id);;

        $record->title = $request->title;
        $record->category_id = $request->category;
        $record->content = $request->content;

        if($request->has('image')){
           $path = $request->file('image')->store('toPath', ['disk' => 'my_files']);
           $record->image = $path;
           $record->update();
           flash()->success('Post has been updated Successfully!');
           return back();

        } else {
            $record->update();
            flash()->success('Post has been updated Successfully!');
            return back();
         }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Post::findOrFail($id);
        $record->delete();
        flash()->success('Post has been deleted!');
        return back();
    }
}
