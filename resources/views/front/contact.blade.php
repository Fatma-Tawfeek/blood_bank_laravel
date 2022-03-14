@extends('front.app')

@section('content')

  <!--contact-us-->
  <div class="contact-us">
        <div class="contact-now">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                        </ol>
                    </nav>
                </div>
                @include('flash::message')
                @include('layouts.partials.validation-errors')
                <div class="row methods">
                    <div class="col-md-6">
                        <div class="call">
                            <div class="title">
                                <h4>اتصل بنا</h4>
                            </div>
                            <div class="content">
                                <div class="logo">
                                    <img src="{{asset('front/imgs/logo.png')}}">
                                </div>
                                <div class="details">
                                    <ul>
                                        <li><span>الجوال:</span>{{$settings->phone}}</li>

                                        <li><span>البريد الإلكترونى:</span>{{$settings->email}}</li>
                                    </ul>
                                </div>
                                <div class="social">
                                    <h4>تواصل معنا</h4>
                                    <div class="icons" dir="ltr">
                                        <div class="out-icon">
                                            <a href="{{$settings->fb_lik}}"><img src="{{asset('front/imgs/001-facebook.svg')}}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="{{$settings->tw_lik}}"><img src="{{asset('front/imgs/002-twitter.svg')}}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="{{$settings->yt_lik}}"><img src="{{asset('front/imgs/003-youtube.svg')}}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="{{$settings->insta_lik}}"><img src="{{asset('front/imgs/004-instagram.svg')}}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="https://web.whatsapp.com/"><img src="{{asset('front/imgs/005-whatsapp.svg')}}"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @auth('client-web')

                    <div class="col-md-6">
                        <div class="contact-form">
                            <div class="title">
                                <h4>تواصل معنا</h4>
                            </div>
                            <div class="fields">
                                <form action="{{route('contact.send')}}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="عنوان الرسالة" name="subject">
                                    <textarea placeholder="نص الرسالة" class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                                    <input type="hidden" name="id" value="{{auth('client-web')->user()->id}}">
                                    <button type="submit">ارسال</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

@stop
