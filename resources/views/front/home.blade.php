@extends('front.app')

@section('content')

        <!--intro-->
        <div class="intro">
            <div id="slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider" data-slide-to="0" class="active"></li>
                    <li data-target="#slider" data-slide-to="1"></li>
                    <li data-target="#slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item carousel-1 active">
                        <div class="container info">
                            <div class="col-lg-5">
                                <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                                <p>
                                    هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.
                                </p>
                                <a href="{{route('about')}}">المزيد</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item carousel-2">
                        <div class="container info">
                            <div class="col-lg-5">
                                <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                                <p>
                                    هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.
                                </p>
                                <a href="{{route('about')}}">المزيد</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item carousel-3">
                        <div class="container info">
                            <div class="col-lg-5">
                                <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                                <p>
                                    هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي.
                                </p>
                                <a href="{{route('about')}}">المزيد</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--about-->
        <div class="about">
            <div class="container">
                <div class="col-lg-6 text-center">
                    <p>
                        <span>بنك الدم</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ.
                    </p>
                </div>
            </div>
        </div>

        <!--articles-->
        <div class="articles">
            <div class="container title">
                <div class="head-text">
                    <h2>المقالات</h2>
                </div>
            </div>
            <div class="view">
                <div class="container">
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
                                    <i id="{{$post->id}}" onclick="toggleFavourite(this)" class="
                                        {{$post->is_favourite ? 'fas fa-heart' : 'far fa-heart'}}
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

        <!--requests-->
        <div class="requests">
            <div class="container">
                <div class="head-text">
                    <h2>طلبات التبرع</h2>
                </div>
            </div>
            <div class="content">
                <div class="container">
                    <form class="row filter">
                        <div class="col-md-5 blood">
                            <div class="form-group">
                                <div class="inside-select">
                                    @inject('bloodTypes', 'App\Models\BloodType')
                                    {!! Form::select('blood_type', $bloodTypes->pluck('name', 'id')->toArray(), null, [
                                        'class' => 'form-control',
                                        'id' => 'exampleFormControlSelect1',
                                        'placeholder' => 'اختر فصيلة الدم'
                                    ]) !!}
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 city">
                            <div class="form-group">
                                <div class="inside-select">
                                    @inject('governorates', 'App\Models\Governorate')
                                    {!! Form::select('governorate', $governorates->pluck('name', 'id')->toArray(), null, [
                                        'class' => 'form-control',
                                        'id' => 'exampleFormControlSelect1',
                                        'placeholder' => 'اختر المحافظة'
                                    ]) !!}
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 search">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="patients">
                        @if ($donations->count())

                        @foreach ($donations->all() as $donation)

                        <div class="details">
                            <div class="blood-type">
                                <h2 dir="ltr">{{$donation->bloodType->name}}</h2>
                            </div>
                            <ul>
                                <li><span>اسم الحالة:</span>{{$donation->patient_name}}</li>
                                <li><span>مستشفى:</span>{{$donation->hospital_name}}</li>
                                <li><span>المدينة:</span>{{$donation->city->name}}</li>
                            </ul>
                            <a href="{{route('donation.request', ['id'=> $donation->id])}}">التفاصيل</a>
                        </div>

                        @endforeach

                        <div class="more">
                            <a href="{{route('donation.requests')}}">المزيد</a>
                        </div>

                        @else

                        <p class="text text-center mb-5">عذرا, لايوجد طلبات تبرع</p>

                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!--contact-->
        <div class="contact">
            <div class="container">
                <div class="col-md-7">
                    <div class="title">
                        <h3>اتصل بنا</h3>
                    </div>
                    <p class="text">يمكنك الإتصال بنا للإستفسار عن معلومة وسيتم الرد عليكم</p>
                    <div class="row whatsapp">
                        <a href="https://web.whatsapp.com/">
                            <img src="{{asset('front/imgs/whats.png')}}">
                            <p dir="ltr">+{{$settings->phone}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--app-->
        <div class="app">
            <div class="container">
                <div class="row">
                    <div class="info col-md-6">
                        <h3>تطبيق بنك الدم</h3>
                        <p>
                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،
                        </p>
                        <div class="download">
                            <h4>متوفر على</h4>
                            <div class="row stores">
                                <div class="col-sm-6">
                                    <a href="https://play.google.com/store">
                                        <img src="{{asset('front/imgs/google.png')}}">
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="https://www.apple.com/eg-ar/app-store/">
                                        <img src="{{asset('front/imgs/ios.png')}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="screens col-md-6">
                        <img src="{{asset('front/imgs/App.png')}}">
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
@endsection

