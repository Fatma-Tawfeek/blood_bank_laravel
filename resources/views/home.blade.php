@extends("layouts.app")

@inject('client', 'App\Models\Client')
@inject('donation', 'App\Models\DonationRequest')
@inject('post', 'App\Models\Post')
@inject('contact', 'App\Models\Contact')

@section('content')

@section('title')
Dashboard
@endsection

@section('subtilte')
Statistics
@endsection

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Clients</span>
                    <span class="info-box-number">{{$client->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-tint"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Donation Requests</span>
                    <span class="info-box-number">{{$donation->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-paragraph"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Posts</span>
                    <span class="info-box-number">{{$post->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-envelope"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Contacts</span>
                    <span class="info-box-number">{{$contact->count()}}</span>
                </div>
            </div>
        </div>
      </div>
  </section>
  <!-- /.content -->
@endsection
