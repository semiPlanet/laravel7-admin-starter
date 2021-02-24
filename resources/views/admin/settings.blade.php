@extends('layouts.admin')
@section('title', 'Settings')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">System Settings</h3>
            </div>
            <form action="{{route('admin.settings.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Brand Name</label>
                                <input type="text" name="brand_name" class="form-control" placeholder="Your project brand name" value="{{setting('brand_name')}}">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <input type="file" class="form-control" name="logo">
                                        @if(setting('logo'))
                                            <img src="{{setting('logo')}}" alt="" style="height:80px">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                        <label>Icon</label>
                                        <input type="file" class="form-control" name="icon">
                                        @if(setting('icon'))
                                            <img src="{{setting('icon')}}" alt="" style="height:80px">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.card-body -->
            </form>
        </div>
    </div>
</div>
@endsection