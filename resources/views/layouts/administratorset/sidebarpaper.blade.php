@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Paper</h3>
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
                    <a href="{{route('abstractunassigned.read')}}">
                        <span class="stats-small__label text-uppercase">abstract unassigned</span>
                    <h6 class="stats-small__value count my-3">{{CountAbstractUnassigned()}}</h6>
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
                    <a href="{{route('abstractunscored.read')}}">
                        <span class="stats-small__label text-uppercase">abstract unscored</span>
                    <h6 class="stats-small__value count my-3">{{CountAbstractUnscored()}}</h6>
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
                    <a href="{{route('abstracttodecide.read')}}">
                        <span class="stats-small__label text-uppercase">abstract scored</span>
                        <h6 class="stats-small__value count my-3">{{CountAbstractScored()}}</h6>
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
                    <a href="{{route('abstractrejected.read')}}">
                        <span class="stats-small__label text-uppercase">paper rejected</span>
                        <h6 class="stats-small__value count my-3">{{CountAbstractRejected()}}</h6>
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
                        <span class="stats-small__label text-uppercase">paper accepted & waiting invoice</span>
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

<div class="row">
    <div class="col-lg col-md-6 col-sm-6 mb-4">
        <div class="stats-small stats-small--1 card card-small">
            <div class="card-body p-0 d-flex">
            <div class="d-flex flex-column m-auto">
                <div class="stats-small__data text-center">
                    <a href="{{route('abstractunreview.read')}}">
                        <span class="stats-small__label text-uppercase">abstract unreview</span>
                        <h6 class="stats-small__value count my-3">{{CountAbstractUnreview()}}</h6>
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
                    <a href="{{route('abstractreview.read')}}">
                        <span class="stats-small__label text-uppercase">abstract review</span>
                        <h6 class="stats-small__value count my-3">{{CountAbstractReview()}}</h6>
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
                    <a href="{{route('abstractreviewedunreview.read')}}">
                        <span class="stats-small__label text-uppercase">abstract reviewed unreview</span>
                        <h6 class="stats-small__value count my-3">{{CountAbstractReviewedUnreview()}}</h6>
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
                    <a href="{{route('abstractreviewedreview.read')}}">
                        <span class="stats-small__label text-uppercase">abstract reviewed after reviewed</span>
                        <h6 class="stats-small__value count my-3">{{CountAbstractReviewedReview()}}</h6>
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
                    <a href="{{route('abstractfinalundecidereviewer.read')}}">
                        <span class="stats-small__label text-uppercase">abstract final undecide reviewer</span>
                        <h6 class="stats-small__value count my-3">{{CountAbstractFinalUndecideReviewer()}}</h6>
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
                    <a href="{{route('abstractfinalundecideadministrator.read')}}">
                        <span class="stats-small__label text-uppercase">abstract final undecide administrator</span>
                        <h6 class="stats-small__value count my-3">{{CountAbstractFinalUndecideAdministrator()}}</h6>
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
    <div class="col-lg col-md-6 col-sm-6 mb-4">
        <div class="stats-small stats-small--1 card card-small">
            <div class="card-body p-0 d-flex">
            <div class="d-flex flex-column m-auto">
                <div class="stats-small__data text-center">
                    <a href="{{route('paperunreview.read')}}">
                        <span class="stats-small__label text-uppercase">paper unreview</span>
                        <h6 class="stats-small__value count my-3">{{CountPaperUnreview()}}</h6>
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
                    <a href="{{route('paperreviewed.read')}}">
                        <span class="stats-small__label text-uppercase">paper reviewed</span>
                        <h6 class="stats-small__value count my-3">{{CountPaperReviewed()}}</h6>
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
                    <a href="{{route('paperunderviewunreview.read')}}">
                        <span class="stats-small__label text-uppercase">paper underview unreview</span>
                        <h6 class="stats-small__value count my-3">{{CountPaperUnderviewUnreview()}}</h6>
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
                    <a href="{{route('paperunderviewreviewed.read')}}">
                        <span class="stats-small__label text-uppercase">paper underview reviewed</span>
                        <h6 class="stats-small__value count my-3">{{CountPaperUnderviewReviewed()}}</h6>
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
                    <a href="{{route('papercameraready.read')}}">
                        <span class="stats-small__label text-uppercase">paper camera ready</span>
                        <h6 class="stats-small__value count my-3">{{CountPaperCameraReady()}}</h6>
                    </a>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
