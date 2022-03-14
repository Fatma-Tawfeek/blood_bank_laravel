@extends('layouts.app')

@section('content')

@section('title')
Clients
@endsection

@section('subtilte')
Client Details
@endsection

  <!-- Main content -->
  <section class="content">


  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Client Details</h3>

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

            <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Name:</th>
                    <td>{{$record->name}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Phone:</th>
                    <td>{{$record->phone}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Email:</th>
                    <td>{{$record->email}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Blood Type:</th>
                    <td>{{$record->bloodType->name}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Governorate:</th>
                    <td>{{$record->city->governorate->name}}</td>
                  </tr>
                  <tr>
                    <th scope="row">City:</th>
                    <td>{{$record->city->name}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Date of Birth:</th>
                    <td>{{$record->d_o_b}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Last Donation Date:</th>
                    <td>{{$record->last_donation_date}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Registeration Date:</th>
                    <td>{{date('j M  Y , g:i a', strtotime($record->created_at))}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection
