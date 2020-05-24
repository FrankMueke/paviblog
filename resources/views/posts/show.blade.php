@extends('main')
@section('title', '| View Post')
@section('content')
<div class="row">
    <div class="col-md-8">
    <img class="postimg" src="{{ asset('images/'.$post->featured_image)}}" alt="Image here">
    <h1 class="posttitile-spacing-top font-spartan">{{ $post->title }}</h1>

    <p class="lead">{!! $post->body !!}</p>
    <hr>

        <div id="backend-comments" style="margin-top: 50px;">
        <h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th width="70px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post->comments as $comment)
                    <tr>
                    <td>{{ $comment->name }}</td>
                    <td>{{ $comment->email }}</td>
                    <td>{{ $comment->comment }}</td>  
                    <td>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-danger btn-block btn-xs"><span><svg class="bi bi-trash-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 00-1 1v1a1 1 0 001 1H3v9a2 2 0 002 2h6a2 2 0 002-2V4h.5a1 1 0 001-1V2a1 1 0 00-1-1H10a1 1 0 00-1-1H7a1 1 0 00-1 1H2.5zm3 4a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7a.5.5 0 01.5-.5zM8 5a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7A.5.5 0 018 5zm3 .5a.5.5 0 00-1 0v7a.5.5 0 001 0v-7z" clip-rule="evenodd"/>
                      </svg></span></button>
                        </form>
                    </td> 
                    </tr>
                    @endforeach    
                </tbody>
            </table>
    </div>
    </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <label><b>Url:</b></label>
                    <p><a href="{{ url('blog/'.$post->slug) }}">{{ url('blog/'.$post->slug) }}</a></p>
                </dl>
                <dl class="dl-horizontal">
                    <label><b>Created At:</b></label>
                <p>{{ date( 'M j, Y h:ia', strtotime($post->created_at)) }}</p>
                </dl>

                <dl class="dl-horizontal">
                    <label><b>Last Updated:</b></label>
                    <p>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</p>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                       
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary btn-block">Edit Post</a>
                    </div>
                <div class="col-sm-6">
                
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block ">Delete the Post </button>
                    </form>
                </div>
                </div>

                </div>
                    <div class="row">
                        <div class="col-md-12 form-spacing-top">
                        <a href="{{ route('posts.index')}}" class="btn btn-info btn-block btn-h1-spacing text-white"><< See All Posts</a>
                        </div>
                    </div>
  </div>
</div>
</div>

@endsection