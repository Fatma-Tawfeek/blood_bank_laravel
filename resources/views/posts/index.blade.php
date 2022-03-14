@extends('layouts.app')

@section('content')

@section('title')
Posts
@endsection

@section('subtilte')
List of posts
@endsection

  <!-- Main content -->
  <section class="content">


  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List of posts</h3>

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
        <a href="{{url(route('post.create'))}}" class="btn btn-primary mb-2"><i class="fa fa-plus mr-2"></i>New Post</a>
        @include('flash::message')
        @if (count($records))
        <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th class="col-md-2">Title</th>
                <th>Category</th>
                <th>Image</th>
                <th class="col-md-3">Content</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$record->title}}</td>
                    <td>{{$record->category->name}}</td>
                    <td><img src="{{asset('img/'.$record->image)}}" class="img-fluid img-thumbnail" style="width:200px;"></td>
                    <td>{{ \Illuminate\Support\Str::limit($record->content, 200)}}</td>
                    <td class="text-center"><a href="{{route('post.edit', $record->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit mr-2"></i>Edit</a></td>
                    <td class="text-center">{!! Form::open([
                        'route' => ['post.destroy', $record->id],
                        'method' => 'delete'
                    ]) !!}
                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash mr-2"></i>Delete</button></td>
                    {!!Form::close()!!}
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
