@extends('layouts.app')

@inject('bloodTypes', 'App\Models\BloodType')
@inject('governorates', 'App\Models\Governorate')

@section('content')

@section('title')
Donation Requests
@endsection

@section('subtilte')
List of donation requests
@endsection

  <!-- Main content -->
  <section class="content">


  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List of donation requests</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">

        <div class="row form-group">
            <!-- Search -->
            <form action="{{route('donation.index')}}" method="GET" class="row col-md-5">
                    @csrf
                <input type="text" name="keyword" value="{{$oldValue}}" class="form-control col-md-8 ml-2" placeholder="Search by name or phone">
                <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
            <!-- .\Search -->

            <!-- Filter -->
            <form action="{{route('donation.index')}}" method="GET" class="row col-md-3">
                <select class="form-control col-md-8 ml-8" name="blood_type">
                    <option>Select Blood Type</option>
                    @foreach ($bloodTypes->all() as $bloodType)
                        <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-danger ml-2"><i class="fa fa-filter" aria-hidden="true"></i></button>
            </form>

            <form action="{{route('donation.index')}}" method="GET" class="row col-md-3">
                <select class="form-control col-md-8 ml-2" name="governorate">
                <option>Select Governorate</option>
                @foreach ($governorates->all() as $governorate)
                    <option value="{{$governorate->id}}">{{$governorate->name}}</option>
                @endforeach
                </select>
            <button type="submit" class="btn btn-danger ml-2"><i class="fa fa-filter" aria-hidden="true"></i></button>
            </form>

        </div>
        <!-- \.Filter -->
        @include('flash::message')

        @if (count($records))
        <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Age</th>
                <th>Blood Type</th>
                <th>Governorate</th>
                <th>Delete</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$record->patient_name}}</td>
                    <td>{{$record->patient_phone}}</td>
                    <td>{{$record->patient_age}}</td>
                    <td>{{$record->bloodType->name}}</td>
                    <td>{{$record->city->governorate->name}}</td>
                    <td class="text-center">
                        {!! Form::open([
                        'route' => ['donation.destroy', $record->id],
                        'method' => 'delete'
                        ]) !!}

                        <button class="btn btn-danger btn-sm" type="submit">
                            <i class="fa fa-trash mr-2"></i>Delete
                        </button>

                        {!!Form::close()!!}
                    </td>
                    <td class="text-center">
                        <a href="{{route('donation.show',['id' => $record->id])}}" class="btn btn-light btn-sm">
                            Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        @else
        <div>
            NO Data
        </div>
        @endif
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection
