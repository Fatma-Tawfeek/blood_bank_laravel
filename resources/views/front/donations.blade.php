@extends('front.app')

@section('content')

        <!--inside-article-->
        <div class="all-requests">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                        </ol>
                    </nav>
                </div>

                <!--requests-->
                <div class="requests">
                    <div class="head-text">
                        <h2>طلبات التبرع</h2>
                    </div>
                    <div class="content">
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
                                <a href="{{route('donation.request', ['id' => $donation->id])}}">التفاصيل</a>
                            </div>

                            @endforeach

                            @else

                            <p class="text text-center mb-5">عذرا, لايوجد طلبات تبرع</p>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>


@stop
