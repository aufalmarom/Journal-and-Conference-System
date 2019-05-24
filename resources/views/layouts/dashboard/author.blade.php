@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Author</h3>
        </div>
    </div>
    <!-- End Page Header -->

    @if (Auth::user()->photo == NULL)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please update your <a href="{{route('profile.read')}}"">profile</a>!</strong>
            </button>
        </div>
    @endif

    @if (CekDocProof() == NULL)
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
            <a href="{{route('authorid.verifikasi')}}">
            <button type="button" class="btn btn-accent">Please verification your personal data!</button></a>
        </div>
    </div>
    @elseif(CekStatusVerifikasiAuthorInfo() == NULL)
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
            <div class="card-header border-bottom">
            <h6 class="m-0">Welcome, {{Auth::user()->name}}! </h6>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                <div class="card-header border-bottom">
                <h6 class="m-0">Please waiting verification your personal data from Administrator</h6>
                </div>
                </div>
            </div>
        </div>
    @else
    <div class="row">
        <div class="col-lg-2 col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                        <a href="#">
                            <span class="stats-small__label text-uppercase">Paper</span>
                        <h6 class="stats-small__value count my-3">{{count(Auth::user()->team)}}</h6>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="col-lg-10 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
            <div class="card-header border-bottom">
            <h6 class="m-0">Welcome, {{Auth::user()->name}}</h6>
            </div>
            </div>
            <br>
            <a class="btn btn-accent" href="{{route('submission.read')}}">Add New Paper</a>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
            <div class="card-header border-bottom">
                <h6 class="m-0">Status Paper</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-small list-group-flush">
                <li class="list-group-item d-flex px-3">
                    @for ($i = 0; $i < count(Auth::user()->team); $i++)
                        <span class="text-semibold text-fiord-blue">{{Auth::user()->team[$i]->paper->title}}</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray">{{StatusPaper(Auth::user()->team[$i]->paper->id)}}</span>
                    @endfor
                </li>
                </ul>
            </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
            <div class="card-header border-bottom">
                <h6 class="m-0">Important Dates</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-small list-group-flush">
                @foreach ($datas_importantdates as $data)
                <li class="list-group-item d-flex px-3">
                <span class="text-semibold text-fiord-blue"><b>{{date('Y',strtotime($data->date_from))}}, {{RangeDateImportantDate($data->id)}}</b> - {{$data->title}}</span>
                </li>
                 @endforeach
                </ul>
            </div>
            </div>
        </div>
    </div>
    @endif



@endsection
