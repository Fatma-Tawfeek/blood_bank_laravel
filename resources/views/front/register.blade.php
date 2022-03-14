@extends('front.app')
@section('content')
        <!--form-->
        <div class="create">
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    @include('flash::message')
                    @include('layouts.partials.validation-errors')
                    <form action="{{route('client.save')}}" method="POST">
                        @csrf
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الإسم">

                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الإلكترونى">

                        <input placeholder="تاريخ الميلاد" name="d_o_b" class="form-control" type="text" onfocus="(this.type='date')" id="date">

                        @inject('bloodTypes', 'App\Models\BloodType')
                        {!! Form::select('blood_type_id', $bloodTypes->pluck('name', 'id')->toArray(), null, [
                            'class' => 'form-control',
                            'id' => 'exampleInputEmail1',
                            'placeholder' => 'اختر فصيلة الدم'
                        ]) !!}

                        @inject('governorates', 'App\Models\Governorate')
                        {!! Form::select('governorate_id', $governorates->pluck('name', 'id')->toArray(), null, [
                            'class' => 'form-control',
                            'id' => 'governorate',
                            'name' => 'governorate_id',
                            'placeholder' => 'اختر المحافظة'
                        ]) !!}

                        {!! Form::select('city_id', [], null, [
                            'class' => 'form-control',
                            'id' => 'cities',
                            'placeholder' => 'اختر المدينة'
                        ]) !!}

                        <input type="number" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="رقم الهاتف">

                        <input placeholder="آخر تاريخ تبرع" name="last_donation_date" class="form-control" type="text" onfocus="(this.type='date')" id="date">

                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="كلمة المرور">

                        <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword1" placeholder="تأكيد كلمة المرور">

                        <div class="create-btn">
                            <input type="submit" value="إنشاء">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    <script>
        $("#governorate").change(function(e) {
            e.preventDefault();

            var governorate_id = $("#governorate").val();
            if (governorate_id)
            {
                $.ajax({
                    url : '{{url('api/v1/cities?governorate_id=')}}'+governorate_id,
                    type : 'get',
                    success: function (data) {
                        if (data.status == 1) {
                            $("#cities").empty();
                            $("#cities").append('<option value="">اختر المدينة</option>');
                            $.each(data.data, function (index, city) {
                                $("#cities").append('<option value="'+city.id+'">'+city.name+'</option>');
                            });
                        }
                    }
                });

            }
            else {
                    $("#cities").empty();
                    $("#cities").append('<option value="">اختر المدينة</option>');
            }
        });

    </script>

    @endpush

@stop



