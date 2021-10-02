<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::where('status',1)->get();
        return view('backend.posts.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();
        return view('backend.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create_data = Post::create([
            'title'=>$request->input('title'),
            'slug'=>$request->input('title'),
            'category_id'=>$request->input('category_id'),
            'description'=>$request->input('description'),
            // 'image'=>$request->input('name'),
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d'),
        ]);

        if($create_data){
            return redirect()->route('posts.index')->with('success','Post Created Successfully');
        }else{
            return redirect()->back()->withErrors(['error'=>'Unable create Post please try after sometime']);
        }
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
        $post = Post::findOrFail($id);
        $categories = Category::where('status',1)->get();
        return view('backend.posts.edit',compact('categories','post'));

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
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->slug = $request->input('title');
        $post->category_id =  (int) $request->input('category_id');
        $post->description = $request->input('description');
            // 'image'=>$request->input('name'),
        $post->updated_at = date('Y-m-d');

        if($post->save()){
            return redirect()->route('posts.index')->with('success','Post Updated Successfully');
        }else{
            return redirect()->back()->withErrors(['error'=>'Unable Update Post please try after sometime']);
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
        $data = Post::find($id);
        $data->delete();
         return redirect()->route('posts.index')->with('Post Deleted Successfully');
    }
}
