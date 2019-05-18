@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Contact Us Section</h3>
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
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @php
        $row = 2;
    @endphp
    @foreach ($datas as $data)
    @if ($row == 2)
    <div class="row">
    @endif
        <div class="col-lg-6">
            <div class="card card-small card-post mb-4">
                <div class="card-body">
                <h5 class="card-title">{{$data->title}}</h5>
                <p class="card-text text-muted">{{$data->message}}</p>
                </div>
                <div class="card-footer border-top d-flex">
                    <div class="card-post__author d-flex col-md-6">
                        <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('public/dashboard/images/avatars/2.jpg');">Written by {{Auth::user()->name}}</a>
                        <div class="d-flex flex-column justify-content-center ml-3">
                        <span class="card-post__author-name">{{$data->name}}</span>
                        <small class="text-muted">{{$data->created_at}}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form method="POST" action="{{route('contactus.readmessage')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="my-auto ml-auto text-right">
                                <button class="btn" type="submit"><i class="fa fa-comment mr-1"></i> Reply </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @if ($row == 0)
    </div>
    @endif
    @php
        $row++;
    @endphp
    @endforeach

@endsection
