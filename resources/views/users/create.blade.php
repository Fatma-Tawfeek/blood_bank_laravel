@extends('layouts.app')

@inject('model', 'App\Models\User')
@inject('role', 'Spatie\Permission\Models\Role')
<?php $roles = $role->pluck('name', 'id')->toArray(); ?>


@section('content')

@section('title')
Users
@endsection

@section('subtilte')
Create user
@endsection

  <!-- Main content -->
  <section class="content">


  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Create user</h3>
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
            'route' => 'users.store',
        ]) !!}
        <label for="name">Name</label>
        {!! Form::text('name', null, [
            'class' =>'form-control'
        ]) !!}

        <label for="email">Email</label>
        {!! Form::email('email', null, [
            'class' =>'form-control'
        ]) !!}

        <label for="password">Password</label>
        {!! Form::password('password', [
            'class' =>'form-control'
        ]) !!}

        <label for="password_confirmation">Password Confirmation</label>
        {!! Form::password('password_confirmation', [
            'class' =>'form-control'
        ]) !!}

        <label for="roles_list">Roles</label>
        {!! Form::select('roles_list[]', $roles, null, [
            'class' =>'form-control',
            'multiple' =>'multiple'
        ]) !!}

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
