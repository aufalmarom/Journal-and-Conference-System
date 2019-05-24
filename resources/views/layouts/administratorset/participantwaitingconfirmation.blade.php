@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Participant Paid & Waiting Confirmation</h3>
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
                        <th class="text-center">Price Must Pay</th>
                        <th class="text-center">Nominal Transfered</th>
                        <th class="text-center">File Proof</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td></td>
                    <td>{{$data->user->id}}</td>
                    <td>{{$data->user->name}}</td>
                    <td>{{$data->user->email}}</td>
                    <td class="text-center">{{Rupiah($data->price)}},-</td>
                    <td class="text-center">{{Rupiah($data->nominal_transfered)}},-</td>
                    <td class="text-center"><img style="width:40px; height:40px; text-align:center; vertical-align:middle" data-pic-title="{{$data->file_proof}}" data-pic="storage/app/public/invoice/{{$data->file_proof}}" src="storage/app/public/invoice/{{$data->file_proof}}"></td>
                    <td class="td-actions text-center">
                    <form method="POST" action="{{route('participant.confirm')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <button type="submit" title="Pembayaran Diterima" class="btn btn-md btn-accent">
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
