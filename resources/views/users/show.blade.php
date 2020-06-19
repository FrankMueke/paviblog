@extends('main')
<?php $titleTag = htmlspecialchars($user->name); ?>
@section('title', '| ' .e($user->name))
@section('content')
<div class="container-fluid">
    <div class="row">
           <div class="col-md-10 offset-1 rounded author-well p-5 mt-1 col-xs-4">
            <div class="">
                <div class="row">
                    <div class="col-xs-2 offset-5 text-center">
                        <img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($user->email)))}} alt="Avatar here" class="author-image">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4 offset-4">
                        <h4 class="text-center heading">{{ $user->name }}</h4>
                        <h4 class="text-center heading"> {{ $user->email }} </h4>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</div>    
<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-2 offset-5 mt-3">
            <h1 class="text-center heading">
              <svg class="bi bi-file-richtext" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
              <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 9h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm1.639-3.708l1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208zM6.25 5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z"/>
            </svg>
            {{ $user->posts()->count() }} Posts</h1>
            <hr>
          </div>
        <div class="col-md-10 offset-1">
            
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th></th>
                </thead> 
    
                <tbody>
    
                    @foreach($posts as $post)
    
                    <tr>
                        <th>{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ substr(strip_tags($post->body), 0, 50) }}{{ strlen(strip_tags($post->body)) > 50 ? "..." : ""}}</td>
                        <td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
                    <td>
                        @if(Auth::id() !== $post->user_id)
                        <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-outline-primary  btn-block btn-sm">View</a>    
                        @else
                        <a href="/posts/{{$post->id}}" class="btn btn-outline-primary btn-block btn-sm">View</a>
                        @endif
                         
                        {{-- <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">View</a> --}}
                        
                        {{-- <a href="{{route('posts.edit', $post->id)}}" class="btn btn-dark btn-sm">Edit</a> --}}
                        @if(Auth::id() == $post->user_id)
                            <a href="{{ action('PostController@edit', [$post->id]) }} " class="btn btn-outline-dark btn-block btn-sm">Edit</a>
                        @endif
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
     
    </div>
</div>
@endsection