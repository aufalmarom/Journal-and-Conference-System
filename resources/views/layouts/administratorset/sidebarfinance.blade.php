@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Finance</span>
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
                        <a href="{{route('participant.verifiedwaitinginvoice')}}">
                            <span class="stats-small__label text-uppercase">Participant Verified & Waiting Invoice </span>
                            <h6 class="stats-small__value count my-3">{{CountParticipantWaitingInvoice()}}</h6>
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
                        <a href="{{route('participant.verifiedunpaid')}}">
                            <span class="stats-small__label text-uppercase">Participant Verified & Unpaid </span>
                        <h6 class="stats-small__value count my-3">{{CountParticipantVerifiedUnpaid()}}</h6>
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
                        <a href="{{route('participant.waitingconfirmation')}}">
                            <span class="stats-small__label text-uppercase">Participant Waiting Confirmation</span>
                            <h6 class="stats-small__value count my-3">{{CountParticipantWaitingConfirmation()}}</h6>
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
                        <a href="{{route('participant.confirmed')}}">
                            <span class="stats-small__label text-uppercase">Participant Confirmed</span>
                            <h6 class="stats-small__value count my-3">{{CountParticipantConfirmed()}}</h6>
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
                        <a href="{{route('abstractacceptedwaitinginvoice.read')}}">
                            <span class="stats-small__label text-uppercase">paper accepted && waiting invoice</span>
                            <h6 class="stats-small__value count my-3">{{CountAbstractAcceptedWaitingInvoice()}}</h6>
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
                    <a href="{{route('papergotinvoiceunpaid.read')}}">
                        <span class="stats-small__label text-uppercase">paper got invoice & unpaid</span>
                        <h6 class="stats-small__value count my-3">{{CountAbstractGotInvoiceUnpaid()}}</h6>
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
                    <a href="{{route('paperwaitingconfirmation.read')}}">
                        <span class="stats-small__label text-uppercase">paper waiting confirm</span>
                        <h6 class="stats-small__value count my-3">{{CountPaperWaitingConfirm()}}</h6>
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
                    <a href="{{route('paper.paid')}}">
                        <span class="stats-small__label text-uppercase">paper paid</span>
                        <h6 class="stats-small__value count my-3">{{CountPaperPaid()}}</h6>
                    </a>
                </div>
            </div>
            </div>
        </div>
    </div>

    </div>

@endsection
