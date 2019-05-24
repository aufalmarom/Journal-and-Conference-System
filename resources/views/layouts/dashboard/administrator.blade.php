@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Overview</h3>
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
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                        <a href="{{route('allreviewer.read')}}">
                            <span class="stats-small__label text-uppercase">Reviewer</span>
                            <h6 class="stats-small__value count my-3">{{CountReviewer()}}</h6>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                        <a href="{{route('paper.total')}}">
                            <span class="stats-small__label text-uppercase">Paper</span>
                            <h6 class="stats-small__value count my-3">{{CountAllPaper()}}</h6>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                        <a href="{{route('author.total')}}">
                            <span class="stats-small__label text-uppercase">Author</span>
                            <h6 class="stats-small__value count my-3">{{CountAllAuthor()}}</h6>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                        <a href="{{route('allparticipant')}}">
                            <span class="stats-small__label text-uppercase">Participant</span>
                            <h6 class="stats-small__value count my-3">{{CountAllParticipant()}}</h6>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                        <a href="{{route('ppt.total')}}">
                            <span class="stats-small__label text-uppercase">Powerpoint</span>
                            <h6 class="stats-small__value count my-3">{{CountAllPowerpoint()}}</h6>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                        <a href="{{route('reregistration.read')}}">
                            <span class="stats-small__label text-uppercase">Re-registration</span>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection
