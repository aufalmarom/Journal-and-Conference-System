@extends('layouts.master.dashboard')

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Welcome Section</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('lp.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>
    @if ($message = Session::get('success'))
        <div class="col-sm-8 alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{$message[1]}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-8 mb-4">
          <div class="card card-small mb-4">
            <div class="card-header border-bottom">
              <h6 class="m-0">Form Inputs</h6>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item p-3">
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <form method="POST" action="{{route('welcome.update')}}" enctype = "multipart/form-data">
                        @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                        <strong class="text-muted d-block mb-2">Logo</strong>
                        <div class="form-group custom-file">
                            <input type="file" name="logo" class="custom-file-input">
                                <label class="custom-file-label" for="validatedCustomFile">{{$data->logo}}</label>
                            <div class="text-right">
                                <span class="medium">*ideal size 65 x 41 px; max size 100KB</span>
                            </div>

                            @if ($message = Session::get('errorlogo'))
                            <div class="text-left">
                            <span class="medium">{{$message}}</span>
                            </div>
                            @endif

                        </div>
                        <div class="form-group">
                            <strong class="text-muted d-block mb-2">Event Short Name</strong>
                            <input type="text" name="brand" class="form-control" placeholder="Short Name" value="{{$data->brand}}" required>
                        </div>
                        <div class="form-group">
                            <strong class="text-muted d-block mb-2">Event Full Name</strong>
                            <input type="text" name="title" class="form-control" placeholder="Full Name" value="{{$data->title}}" required>
                        </div>
                        <div class="form-group">
                            <strong class="text-muted d-block mb-2">Event Theme</strong>
                            <input type="text" name="main_theme" class="form-control" id="validationServer03" placeholder="Tema Acara" value="{{$data->main_theme}}" required>
                        </div>
                        <div class="form-group">
                            <strong class="text-muted d-block mb-2">Time</strong>
                            <input type="text" name="tanggal" class="form-control" id="daterangepicker" placeholder="Time" value="{{$data->date_from}} - {{$data->date_to}}" required>
                        </div>
                        <div class="form-group">
                            <strong class="text-muted d-block mb-2">Location</strong>
                            <input type="text" name="location" class="form-control" placeholder="Location" value="{{$data->location}}" required>
                        </div>
                        <div class="form-group">
                            <strong class="text-muted d-block mb-2">Overview</strong>
                            <input type="text" name="overview" class="form-control" placeholder="Overview" value="{{$data->overview}}" required>
                        </div>
                        <button type="submit" class="mb-2 btn btn-primary mr-2">Save</button>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
    </div>

    <script src="<?php echo asset('public/landingpage/js/jquery.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('#daterangepicker').daterangepicker({
                locale: {
						format: 'YYYY-MM-DD',
						},
            });
        });
    </script>

@endsection
