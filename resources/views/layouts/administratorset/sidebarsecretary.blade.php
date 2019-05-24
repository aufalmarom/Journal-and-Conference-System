@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Secretary</span>
            <h3 class="page-title">Overview</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('dashboard')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Dashboard</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                        <a href="{{route('participant.confirmed')}}">
                            <span class="stats-small__label text-uppercase">Participant Confirmed</span>
                            <h6 class="stats-small__value count my-3">{{CountParticipantConfirmed()}}</h6>
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
                        <a href="{{route('author.confirmed')}}">
                            <span class="stats-small__label text-uppercase">Author Confirmed ID</span>
                            <h6 class="stats-small__value count my-3">{{CountAuthorConfirmedID()}}</h6>
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
                        <a href="{{route('abstractfinaldecided.read')}}">
                            <span class="stats-small__label text-uppercase">abstract final decided</span>
                            <h6 class="stats-small__value count my-3">{{CountAbstractFinalDecided()}}</h6>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection
