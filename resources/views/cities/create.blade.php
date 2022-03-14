@extends('layouts.app')

@inject('model', 'App\Models\City')

@section('content')

@section('title')
City
@endsection

@section('subtilte')
Create cities
@endsection

  <!-- Main content -->
  <section class="content">


  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Create cities</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- card-body -->
      <div class="card-body">
        <div class="form-group">

        @include('layouts.partials.validation-errors')

        {!! Form::model($model, [
            'route' => 'cities.store'
        ]) !!}

        <label for="name">Name</label>
        {!! Form::text('name', null, [
            'class' =>'form-control'
        ]) !!}

        <label for="governorate_id">Governorate</label>
        <select class="form-control" name="governorate_id" id="governorate_id">
            <option>Select Item</option>
            @foreach ($records as $key => $value)
                <option value="{{ $key }}" >
                    {{ $value }}
                </option>
            @endforeach
        </select>

        {!!Form::submit('Submit',[
            'class' =>'btn btn-primary mt-2'
        ])!!}

         {!! Form::close() !!}
    </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection
