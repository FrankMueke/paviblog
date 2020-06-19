@extends('main')
@section('title', '| Homepage')
@section('content')

      <div class="container-fluid container-spacing-top">
          <div class="row no-gutters">
              <div class="col-md-12 col-xs-3">
                <div class="jumbotron">
                    <h1 class="display-4 text-danger">Welcome to my site!</h1>
                    <p class="lead">   This is the home news , sports. entertainment and politics. This is the home news , sports. entertainment ans politics.</br>
                        Please check our latest posts here
                    .</p>
                    <hr class="my-4">
                    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>

                  </div>
              </div>
          </div><!--end of header .row -->

          <div class="row">
              <div class="col-md-8 col-xs-1 rounded postbackground">
                @foreach($posts as $post)

                 <div class="post rounded">
                  <div class="backlink-name-wrapper">
                    <div class="backlink-name">
                      <span class="backlink-date">{{ date('M j, Y, h:ia', strtotime ($post->created_at)) }}</span>
                    </div>
                    <span class="backlink-author">By {{ $post->user->name }}</span>
                  </div>
                     <div class="post-image">


                            <a href="{{ url('blog/'.$post->slug) }}"><img class="postimg" src="{{ asset('images/'. $post->featured_image )}}" height="150" width="300" alt="Image here"></a>
                        </div>
                        <div class="post-content flex-fill">
                        <a class="text-body" href="{{ url('blog/'.$post->slug) }}"> <h3 class="ptitle-style">{{ $post->title }}</h3></a>

                          <p>{{ substr(strip_tags($post->body), 0, 200) }}{{ strlen(strip_tags($post->body)) > 200 ? "..." : "" }}</p>
                      {{-- <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a> --}}
                          </div>

                    </div>
                <hr>
                @endforeach

              </div>


              <div class="col-md-4 col-xs-1">
                  <h2 class="ptitle-style bg-danger text-white rounded">Latest Trending News</h2>
                    <div class="list-group postbackground rounded">
                      <ol class="ptitle-style text-danger">
                      @foreach($posts->take(10) as $post)
                      <li><a href="{{ url('blog/'.$post->slug) }}" class="list-group-item list-group-item-action list-group-item-secondary" "><h6>{{ substr(strip_tags($post->title), 0, 40) }}{{ strlen(strip_tags($post->title))>40 ? "...": "" }}</h6></a>
                      </li>
                          @endforeach
                      </ol>
                    </div>
                    <hr>
                    {{-- second sidebar --}}
                    <h2 class="ptitle-style bg-danger text-white rounded">AD 1</h2>
                    <div class="list-group postbackground">
                    <ol class="ptitle-style text-danger">
                        @foreach($posts->take(10) as $post)
                        <li><a href="{{ url('blog/'.$post->slug) }}" class="list-group-item list-group-item-action list-group-item-secondary" "><h6>{{ substr(strip_tags($post->title), 0, 40) }}{{ strlen(strip_tags($post->title))>40 ? "...": "" }}</h6></a>
                        </li>
                            @endforeach
                        </ol>
                    </div>
                    <hr>
                    {{-- second sidebar --}}
                    <h2 class="ptitle-style bg-danger text-white rounded">AD 2</h2>
                    <div class="list-group postbackground">
                    <ol class="ptitle-style text-danger">
                        @foreach($posts->take(10) as $post)
                        <li><a href="{{ url('blog/'.$post->slug) }}" class="list-group-item list-group-item-action list-group-item-secondary" "><h6>{{ substr(strip_tags($post->title), 0, 40) }}{{ strlen(strip_tags($post->title))>40 ? "...": "" }}</h6></a>
                        </li>
                            @endforeach
                        </ol>
                    </div>

            </div>
              <div class="offset-5">
                {{ $posts->links() }}
           </div>
          </div><!--end of row-->

    </div><!--end of container -->
@endsection
