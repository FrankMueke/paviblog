@extends('main')
@section('title', '|All Posts')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-xs-4">
            <div class="h1 heading">All Posts</div>
        </div>
        <div class="col-md-2 col-xs-1">
        {{-- <a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary">Create New Post</a> --}}
        <a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary">Create New Post</a>
        </div>
        <div class="col-md-12 col-xs-4">
            <hr>
        </div>
    </div> <!--end of row -->
    <div class="row">
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
                        <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-outline-primary btn-sm btn-block">View</a>    
                        @else
                        <a href="/posts/{{$post->id}}" class="btn btn-outline-primary btn-sm btn-block">View</a>
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
        
            <div class="text-center">
                {{ $posts->links() }}
           </div>
        </div>
    </div>
</div>
@endsection