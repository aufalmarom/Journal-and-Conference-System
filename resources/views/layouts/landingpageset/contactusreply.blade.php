@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Reply Us Section</h3>
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


    <div class="container py-4">
        <div class="row justify-content-md-center px-4">
        <div class="contact-form col-sm-12 col-md-10 col-lg-7 p-4 mb-4 card">
            <form method="POST" action="{{route('contactus.reply')}}">
                @csrf
            <div class="row">
                <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="contactFormFullName">To : {{$data->name}}</label>
                </div>
                </div>
                <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="contactFormEmail">{{$data->email}}</label>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="contactFormFullName">Subject: {{$data->title}}</label></div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                <div class="form-group">
                    <label for="exampleInputMessage1">{{$data->message}}</label>
                    <input type="hidden" name="id" value="{{$data->id}}">
                <textarea id="exampleInputMessage1" class="form-control mb-4" rows="10" placeholder="Enter your answer..." name="answer" required>{{@$data->answer}}</textarea>
                </div>
                </div>
            </div>
            <input class="btn btn-primary btn-pill d-flex ml-auto mr-auto" type="submit" value="Send Your Message">
            </form>
        </div>
        </div>
    </div>

@endsection
