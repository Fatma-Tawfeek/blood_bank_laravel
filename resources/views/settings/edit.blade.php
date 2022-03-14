@extends('layouts.app')

@section('content')

@section('title')
Settings
@endsection

@section('subtilte')
Edit settings
@endsection

  <!-- Main content -->
  <section class="content">

  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit settings</h3>
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
                'route' => 'settings.update',
                'method' => 'PUT'
            ]) !!}

            <label for="email">Email</label>
            {!! Form::email('email', $record->email, [
                'class' =>'form-control'
            ]) !!}

            <label for="phone">Phone</label>
            {!! Form::number('phone', $record->phone, [
                'class' =>'form-control'
            ]) !!}

            <label for="fb_link">Facebook Link</label>
            {!! Form::text('fb_link', $record->fb_link, [
                'class' =>'form-control'
            ]) !!}

            <label for="tw_link">Twitter Link</label>
            {!! Form::text('tw_link', $record->tw_link, [
                'class' =>'form-control'
            ]) !!}

            <label for="insta_link">Instagram Link</label>
            {!! Form::text('insta_link', $record->insta_link, [
                'class' =>'form-control'
            ]) !!}

            <label for="yt_link">Youtube Link</label>
            {!! Form::text('yt_link', $record->yt_link, [
                'class' =>'form-control'
            ]) !!}

            <label for="notifications_settings_text">Notifications Settings Text</label>
            {!! Form::textarea('notifications_settings_text', $record->notifications_settings_text, [
                'class' =>'form-control'
            ]) !!}

            <label for="about_app">About App</label>
            {!! Form::textarea('about_app', $record->about_app, [
                'class' =>'form-control'
            ]) !!}

            {!!Form::submit('Submit',[
                'class' =>'btn btn-primary mt-2'
            ])!!}
        </div>
        {!! Form::close() !!}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
@endsection
