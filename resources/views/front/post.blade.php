@extends('front.app')

@section('content')

        <!--inside-article-->
        <div class="article-details">
        <div class="inside-article">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="#">المقالات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$post->category->name}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="article-image">
                    <img src="{{asset('img/'.$post->image)}}">
                </div>
                <div class="article-title col-12">
                    <div class="h-text col-6">
                        <h4>{{$post->title}}</h4>
                    </div>
                    <div class="icon col-6">
                        <button type="button"><i id="{{$post->id}}" onclick="toggleFavourite(this)" class="
                            {{$post->is_favourite ? 'fas fa-heart' : 'far fa-heart'}}
                            "></i></button>
                    </div>
                </div>

                <!--text-->
                <div class="text">
                    <p>
                        {{$post->content}}
                    </p>
                </div>

                <!--articles-->
                <div class="articles">
                    <div class="title">
                        <div class="head-text">
                            <h2>مقالات ذات صلة</h2>
                        </div>
                    </div>
                    <div class="view">
                        <div class="row">
                            <!-- Set up your HTML -->
                            <div class="owl-carousel articles-carousel">
                                @foreach ($posts as $post)

                            <div class="card">
                                <div class="photo">
                                    <img src="{{asset('img/'.$post->image)}}" class="card-img-top" alt="...">
                                    <a href="{{route('post.details',['id' => $post->id])}}" class="click">المزيد</a>
                                </div>

                                <a class="favourite">
                                    <i id="{{$post->id}}" onclick="toggleFavourite(this)" class="far fa-heart
                                        {{$post->is_favourite ? 'second-heart' : 'first-heart'}}
                                        "></i>
                                </a>

                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p class="card-text">
                                        {{\Illuminate\Support\Str::limit($post->content, 220)}}
                                    </p>
                                </div>
                            </div>

                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')

        <script>
            function toggleFavourite(heart) {
                var post_id = heart.id;
                $.ajax({
                    url : '{{url(route('toggle-favourite'))}}',
                    type : 'post',
                    data : {_token:"{{csrf_token()}}",post_id: post_id},
                    success: function (data) {
                        if (data.status == 1) {
                            var currentClass = $(heart).attr('class');
                            if (currentClass.includes('fas')) {
                                $(heart).removeClass('fas fa-heart').addClass('far fa-heart');
                            } else {
                                $(heart).removeClass('far fa-heart').addClass('fas fa-heart');
                            }
                        }
                    },
                    error: function (jqkhr, textStauts, errorMessage) {
                    alert(errorMessage); }
                });

            }
            </script>

        @endpush
@stop
