@extends('layouts.app')

@section('content')

@section('title')
Contacts
@endsection

@section('subtilte')
List of contacts
@endsection

  <!-- Main content -->
  <section class="content">


  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List of contacts</h3>

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

          <!-- Filter -->
        <form action="{{route('contacts.index')}}" method="GET">
            <div class="row form-group">
                @csrf
                <label for="from">From</label>
                <input type="date" id="from" name="from" class="form-control col-md-4 mx-2">
                <label for="to">To</label>
                <input type="date" id="to" name="to" class="form-control col-md-4 mx-2">
                <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-filter" aria-hidden="true"></i></button>
            </div>
        </form>
        <!-- .\Filter -->
        @include('flash::message')
        @if (count($records))
        <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Sent At</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th class="col-md-4">Message</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{date('j M  Y , g:i a', strtotime($record->created_at))}}</td>
                    <td>{{$record->client->name}}</td>
                    <td>{{$record->client->email}}</td>
                    <td>{{$record->subject}}</td>
                    <td>{{$record->message}}</td>
                    <td class="text-center">{!! Form::open([
                        'route' => ['contacts.destroy', $record->id],
                        'method' => 'delete'
                    ]) !!}
                    <button class="btn btn-danger btn-sm" type="submit">
                        <i class="fa fa-trash mr-2"></i>Delete
                    </button>
                    {!!Form::close()!!}
                </td>
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
