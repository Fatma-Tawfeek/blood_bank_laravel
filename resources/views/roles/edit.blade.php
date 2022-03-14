@extends('layouts.app')

@inject('permissions', 'Spatie\Permission\Models\Permission')

@section('content')

@section('title')
Roles
@endsection

@section('subtilte')
Edit role
@endsection

  <!-- Main content -->
  <section class="content">


  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit role</h3>
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
            {!! Form::open( [
                'route' => ['roles.update', $record->id],
                'method' => 'PUT'
            ]) !!}
            <label for="name">Name</label>
            {!! Form::text('name', $record->name, [
                'class' =>'form-control'
            ]) !!}

            <label for="permission">Permissions:</label>
            <br>
            <input id="selectAll" type="checkbox"><label for='selectAll'>Select All</label>
            <div class="row">
                @foreach ($permissions->all() as $permission)
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="permissions_list[]" value="{{$permission->id}}"
                                @if ($record->hasPermissionTo($permission->id))
                                checked
                                @endif
                                > {{$permission->name}}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            {!!Form::submit('Submit',[
                'class' =>'btn btn-primary mt-2'
            ])!!}

            @push('scripts')

            <script>
            $("#selectAll").click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

            });
            </script>
            @endpush
            {!! Form::close() !!}
            </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection
