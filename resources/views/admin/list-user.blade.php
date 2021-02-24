@extends('layouts.admin')
@section('title', 'Users List')
@section('content')
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Users Listing</h3>

        <div class="card-tools">
            <form action="{{route('admin.list-users')}}" id="search-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <select name="per_page" class="form-control" id="per_page">
                                @for($i=10; $i<=100; $i= $i+10)
                                    <option value="{{$i}}" {{$i==request('per_page')?'selected':''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{request('search')??''}}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="user-manage table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Last Ip</th>
                        <th>Last Login</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td>{{$index + $users->firstItem()}}</td>
                            
                            <td>
                                <img src="{{$user->image}}" alt="" class="img-responsive user-img">
                                {{$user->name}}
                            </td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->ips(true)->ip}}</td>
                            <td>{{$user->updated_at->diffForHumans()}}</td>
                            <td></td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="7">No data available!</td>
                    </tr>
                    @endforelse
                </tbody>
                
                <tfooter>
                   <tr>
                       <td colspan="7">
                       {{$users->links()}}
                       </td>
                   </tr>
                </tfooter>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
</div>
@endsection