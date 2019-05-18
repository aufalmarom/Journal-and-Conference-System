@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Profile</h3>
        </div>
    </div>
    <!-- End Page Header -->

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($message = Session::get('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="col-lg-8">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Change Password</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                    <form method="POST" action="{{route('changepassword.post')}}" ">
                    @csrf
                        <input type="hidden" name="id" value="{{Auth::user()->id}}" required>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="current_password" placeholder="Current Password" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new_password" placeholder="New Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required> </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-accent">Simpan Perubahan</button>
                    </form>
                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>

@endsection
