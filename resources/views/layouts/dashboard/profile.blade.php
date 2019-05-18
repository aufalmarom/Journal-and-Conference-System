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

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('dashboard')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Dashboard</a>
        </div>
    </div>
    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if($message = Session::get('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-3">
            <div class="card-header border-bottom text-center">
                <div class="mb-3 mx-auto">
                    <img class="rounded-circle" src="storage/app/public/user/{{Auth::user()->photo}}" alt="User Avatar" width="110">
                </div>
                <h4 class="mb-0">{{Auth::user()->name}}</h4>
                <span class="text-muted d-block mb-2">{{PrintRole()}}</span>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-4">
                <span>{{Auth::user()->description}}</span>
                </li>
                <li class="list-group-item p-4">
                    <div class="row justify-content-center"><a href="{{route('changepassword.read')}}">
                        <button type="submit" class="btn btn-accent"> Reset Password </button></a>
                    </div>
                </li>
            </ul>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Account Details</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                    <form method="POST" action="{{route('profile.post')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{Auth::user()->id}}">
                        <div class="row">
                            <div class="col-sm-12">
                                    <label for="feFirstName">Photo*</label>
                                <div class="form-group custom-file">
                                    <input type="file" name="photo" class="custom-file-input" placeholder="Photo">
                                <label class="custom-file-label">{{Auth::user()->photo}}</label>
                                </div>
                                <p class="small">Max size 100KB; filetype jpg, jpeg.</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="feFirstName">Name*</label>
                                <input type="text" class="form-control" name="name" id="feFirstName" placeholder="Full Name" value="{{Auth::user()->name}}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="feEmailAddress">Email*</label>
                                <input type="email" class="form-control" name="email" id="feEmailAddress" placeholder="Email" value="{{Auth::user()->email}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="feInputAddress">Phone Number*</label>
                                <input type="tel" class="form-control" name="phone" id="feInputAddress" placeholder="Your Number" value="{{Auth::user()->phone}}" required> </div>
                        <div class="form-group">
                        <label for="feInputAddress">Address</label>
                        <input type="text" name="address" class="form-control" id="feInputAddress" placeholder="Your Address" value="{{Auth::user()->address}}"> </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="feInputCity">Country</label>
                            <input type="text" name="country" class="form-control" id="feInputCity" value="{{Auth::user()->country}}"> </div>
                        <div class="form-group col-md-6">
                            <label for="inputZip">Affiliation*</label>
                            <input type="text" name="affiliation" class="form-control" id="inputZip" value="{{Auth::user()->affiliation}}" required> </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="feDescription">Description</label>
                            <textarea class="form-control" name="description" rows="5">{{Auth::user()->description}}</textarea>
                        </div>
                        </div>
                        <p class="small">*required form</p>
                        <button type="submit" class="btn btn-accent">Simpan Perubahan</button>
                    </form>
                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>
    </div>

@endsection
