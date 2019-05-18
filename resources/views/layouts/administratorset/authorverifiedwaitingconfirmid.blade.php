@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Author Verified Waiting Confirm ID</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('sidebarauthor')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Document Proof</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td></td>
                    <td>{{$data->user->name}}</td>
                    <td>{{$data->user->email}}</td>
                    <td class="text-center"><img style="width:40px; height:40px; text-align:center; vertical-align:middle" data-pic-title="{{$data->doc_proof}}" data-pic="storage/app/public/datadiri/{{$data->doc_proof}}" src="storage/app/public/datadiri/{{$data->doc_proof}}"></td>
                    <td class="td-actions text-center">
                        <a href="{{route('statusID.post', $data->id_user)}}">
                            <button type="button" title="Send Invoice" class="btn btn-md btn-link">
                                <i class="material-icons">message</i>
                            </button>
                        </a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


   @endsection
