@extends('main')
@section('title', ' | Create Post')
@section('stylesheets')

<script src="https://cdn.tiny.cloud/1/janthy1k75r6i1phmsnvompai1l4r33o0aatavvoggd9wo6n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
 <script>
      tinymce.init({
        selector: '#textarea',
        plugins: 'link code',
        menubar: false
      });
    </script>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Create a new Post</h1>
            <hr>
        <form action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control">
            </div>
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" name="featured_image" class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="textarea" type="text" name="body" class="form-control" rows="15"></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block">Create a new post</button>
    </form>
        </div>    
    </div>    

@endsection
@section('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@endsection

