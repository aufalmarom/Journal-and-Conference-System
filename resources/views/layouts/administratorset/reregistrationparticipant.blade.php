@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Reregistration - Participant</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('reregistration.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    <div class="row">
            <div class="col">
                <table id="myTable" class="ui celled table" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($datas as $data)
                        <tr>
                        <td></td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td class="text-center">{{StatusAllParticipant()}}</td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>

@endsection
