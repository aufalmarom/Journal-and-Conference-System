@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">List Participant Verified & Unpaid</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('sidebarparticipant')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('sidebarfinance')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Finance</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col">
            <table id="myTable" class="ui celled table" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID User</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td></td>
                    <th>ID User</th>
                    <td>{{$data->user->name}}</td>
                    <td>{{$data->user->email}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
