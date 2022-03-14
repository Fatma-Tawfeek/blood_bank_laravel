@extends('layouts.app')

@section('content')

@section('title')
Donation Requests
@endsection

@section('subtilte')
Donation Request Details
@endsection

  <!-- Main content -->
  <section class="content">


  <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Donation Request Details</h3>

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
                    <td>{{$record->patient_name}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Phone:</th>
                    <td>{{$record->patient_phone}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Age:</th>
                    <td>{{$record->patient_age}}</td>
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
                    <th scope="row">Bags Number:</th>
                    <td>{{$record->bags_number}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Hospital Name:</th>
                    <td>{{$record->hospital_name}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Hospital Address:</th>
                    <td>{{$record->hospital_address}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Details:</th>
                    <td>{{$record->details}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Location:</th>
                    <td>{{$record->latitude}} {{$record->longitude}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Request Poster:</th>
                    <td>{{$record->client->name}}</td>
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
