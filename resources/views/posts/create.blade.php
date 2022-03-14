@extends('layouts.app')

@inject('model', 'App\Models\Post')

@section('content')

@section('title')
Posts
@endsection

@section('subtilte')
Create post
@endsection

  <!-- Main content -->
  <section class="content">

  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Create post</h3>
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
        @include('layouts.partials.validation-errors')
        {!! Form::model($model, [
            'route' => 'post.store',
            'enctype' => 'multipart/form-data'
        ]) !!}

       <div class="form-group">
        <label for="title">Title</label>
        {!! Form::text('title', null, [
            'class' =>'form-control'
        ]) !!}

        <label for="category">Category</label>
        <select class="form-control" name="category" id="category">
            <option>Select Category</option>
            @foreach ($records as $key => $value)
                <option value="{{ $key }}" >
                    {{ $value }}
                </option>
            @endforeach
        </select>

        <label for="content">Content</label>
        {!! Form::textarea('content', null, [
            'class' =>'form-control mb-3'
        ]) !!}

        <label for="image" class="d-block">Post image</label>
        {!! Form::file('image', [
            'class' =>'form-control'
        ]) !!}

        {!!Form::submit('Submit',[
        'class' =>'btn btn-primary mt-2'
        ])!!}

        {!! Form::close() !!}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
@endsection
