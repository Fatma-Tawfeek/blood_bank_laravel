@extends('layouts.app')

@section('content')

@section('title')
Posts
@endsection

@section('subtilte')
Edit post
@endsection

  <!-- Main content -->
  <section class="content">

  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit post</h3>
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
        @include('flash::message')
        @include('layouts.partials.validation-errors')
        {!! Form::open([
            'route' => ['post.update', $record->id],
            'method' => 'PUT',
            'enctype' => 'multipart/form-data'
        ]) !!}

        <label for="title">Title</label>
        {!! Form::text('title', $record->title, [
            'class' =>'form-control'
        ]) !!}

        <label for="category">Category</label>
        <select class="form-control" name="category" id="category">
            <option value="{{$record->category_id}}">{{$record->category->name}}</option>
            @foreach ($categories as $key => $value)
                <option value="{{ $key }}" >
                    {{ $value }}
                </option>
            @endforeach
        </select>

        <label for="content">Content</label>
        {!! Form::textarea('content', $record->content, [
            'class' =>'form-control mb-3'
        ]) !!}

        <label for="image" class="d-block">Post image</label>
        <img src="{{asset('img/'.$record->image)}}" class="img-thumbnail mb-2" style="display:block; width:200px;">
        {!! Form::file('image', [
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
