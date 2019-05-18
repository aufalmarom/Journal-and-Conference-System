@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Participant</h3>
        </div>
    </div>
    <!-- End Page Header -->

    @if (Auth::user()->photo == NULL)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please update your <a href="{{route('profile.read')}}"">profile</a>!</strong>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
            <div class="card-header border-bottom">
            <h6 class="m-0">Welcome, {{Auth::user()->name}}!
            </h6>
            </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
            <div class="card-header border-bottom">
                <h6 class="m-0">Status Participant</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-small list-group-flush">
                <li class="list-group-item d-flex px-3">
                    <span class="text-semibold text-fiord-blue">{{StatusParticipant()}}</span>
                </li>
                </ul>
            </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
            <div class="card-header border-bottom">
                <h6 class="m-0">Important Date</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-small list-group-flush">
                <li class="list-group-item d-flex px-3">
                    <span class="text-semibold text-fiord-blue"><b>2019, Sept 17-18</b> - Conference</span>
                </li>
                </ul>
            </div>
            </div>
        </div>
    </div>
   @endsection
