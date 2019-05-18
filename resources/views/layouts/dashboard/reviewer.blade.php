@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Reviewer</h3>
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
            <h6 class="m-0">Welcome, {{Auth::user()->name}}!</h6>
            </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
            <div class="card-header border-bottom">
                <h6 class="m-0">To Do</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-small list-group-flush">
                    <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">There is {{CountPaperUnscoredUnreview()}} abstract to score. Please check Paper Menu and Abstract To Score Sub Menu!</span><br>
                    </li>
                    <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">There is - abstract to review. Please check Paper Menu and Abstract To Review Sub Menu!</span>
                    </li>
                    <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">There is - abstract reviewed to review. Please check Paper Menu and Abstract Reviewed Sub Menu!</span>
                    </li>
                    <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">There is - abstract final to decide presentation. Please check Paper Menu and Abstract Final Sub Menu!</span>
                    </li>
                    <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">There is - paper to wait review. Please check Paper Menu and Full Paper Sub Menu!</span>
                    </li>
                    <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">There is - paper underview to review. Please check Paper Menu and Full Paper Underview Sub Menu!</span>
                    </li>
                    <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">There is - paper camera ready to see. Please check Paper Menu and Full Paper Camera Ready Sub Menu!</span>
                    </li>
                </ul>
            </div>
            </div>
        </div>
    </div>

@endsection
