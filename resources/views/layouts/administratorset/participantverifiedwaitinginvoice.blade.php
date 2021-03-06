@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Participant Waiting Invoice</h3>
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

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col">
            <table id="myTable" class="ui celled table" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID User</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td></td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td class="td-actions text-center">
                        <form method="POST" action="{{route('formsendinvoiceparticipant')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <button type="submit" title="Send Invoice" class="btn btn-accent">
                                <i class="material-icons">message</i>
                            </button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


   @endsection
