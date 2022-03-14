@extends('layouts.app')

@section('content')

@section('title')
Roles
@endsection

@section('subtilte')
List of roles
@endsection

  <!-- Main content -->
  <section class="content">


  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List of roles</h3>

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
        <a href="{{url(route('roles.create'))}}" class="btn btn-primary mb-2"><i class="fa fa-plus mr-2"></i>New Role</a>
        @include('flash::message')
        @if (count($records))
        <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Permissions</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$record->name}}</td>
                    <td class="col-md-4">
                        @foreach ($record->permissions as $permission)
                        <span class="badge badge-warning">{{$permission->name}}</span>
                        @endforeach
                    </td>
                    <td class="text-center"><a href="{{url(route('roles.edit',$record->id))}}" class="btn btn-success btn-sm"><i class="fa fa-edit mr-2"></i>Edit</a></td>
                    <td class="text-center">{!! Form::open([
                        'route' => ['roles.destroy', $record->id],
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
        <div class="alert alert-dangor" rule="alert">
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
