
@php
    $blogs = \App\Models\Blog::latest()->limit(3)->get();
@endphp


<section class="blog">
    <div class="container">
        <div class="row gx-0 justify-content-center">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6 col-sm-9">
                <div class="blog__post__item">
                    <div class="blog__post__thumb">
                        <a href="{{route('details.blog',$blog->id)}}"><img src="{{asset($blog->blog_image)}}" alt=""></a>
                        <div class="blog__post__tags">
                            <a href="blog.html">{{$blog->category->name}}</a>
                        </div>
                    </div>
                    <div class="blog__post__content">
                        <span class="date">{{Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}</span>
                        <h3 class="title"><a href="{{route('details.blog',$blog->id)}}">{{$blog->blog_title}}</a></h3>
                        <a href="{{route('details.blog',$blog->id)}}" class="read__more">Read mORe</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="blog__button text-center">
            <a href="{{route('home.blog')}}" class="btn">more blog</a>
        </div>
    </div>
</section>
