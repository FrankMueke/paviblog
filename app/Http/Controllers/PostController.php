<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(20);
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate 
        $this->validate($request, array(
            'title' => 'required|max:60',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'featured_image' => 'sometimes|image',
            'body' => 'required'
        ));
        //Store in the db
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post['user_id'] = Auth::user()->id;

        //save image
        if($request->hasfile('featured_image')){
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(400, 200)->save($location);

            $post->featured_image = $filename;
        }
        $post->save();

       $request->Session()->flash('success', 'The blog post was saved successfully');

       return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(Auth::id() !== $post->user_id) {
            return view('posts.show')->withErrors('You cannot do that');
        } else {
            return view('posts.edit')->withPost($post);
        }
      
        


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
        //validate
        $post = Post::find($id);
        $this->validate($request,array(
            'title' => 'required|max:60',
            'slug' =>"required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'featured_image' => 'image',
            'body' => 'required'
        ));
        //save the data into db
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post['user_id'] = Auth::user()->id;

        //save image
        if($request->hasFile('featured_image')){
            $featured_image = $request->file('featured_image');
            $filename = time() . '.' . $featured_image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($featured_image)->resize(400, 800)->save($location);

            $oldfilename = $post->featured_image;
            //update the db
            $post->featured_image = $filename;
            //delete the old photo
            Storage::delete($oldfilename);
        }
        $post->save();

       $request->Session()->flash('success', 'The blog post was updated successfully');

       return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $post = Post::find($id);
        Storage::delete($post->featured_image);
        

        $post->delete();

        $request->Session()->flash('success', 'Post deleted successfully');

        return redirect()->route('posts.index');
    }
}
