@extends('layouts.admin')

@section('content')
<div class="row">
    <!-- ./col -->
    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{userSummary()}}</h3>

          <p>User Registered</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-12">
    <div class="recent-users card card-default">
      <div class="card-header">
        <div class="card-title">
          Recent Logins
        </div>
      </div>
      <div class="card-body">
        <div class="row">
        @forelse(recentUsers() as $user)
          <div class="col-sm-2">
            <div class="user">
              <img src="{{$user->image??'dist/img/default-150x150.png'}}" alt="">
              <div class="user-extra">{{$user->name}}</div>
              <div class="user-extra">{{$user->updated_at->diffForHumans()}}</div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <p>No data available!</p>
          </div>
        @endforelse
        </div>
      </div>
      <div class="card-footer text-center">
        <a href="#">View all <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection