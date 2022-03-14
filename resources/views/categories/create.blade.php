@extends('layouts.app')

@inject('model', 'App\Models\Governorate')

@section('content')

@section('title')
Categories
@endsection

@section('subtilte')
Create category
@endsection

  <!-- Main content -->
  <section class="content">


  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Create category</h3>
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
            'route' => 'categories.store',
        ]) !!}
        <label for="name">Name</label>
        {!! Form::text('name', null, [
            'class' =>'form-control'
        ]) !!}
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
