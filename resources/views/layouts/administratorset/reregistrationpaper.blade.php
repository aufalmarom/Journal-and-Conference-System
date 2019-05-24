@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Reregistration - Paper / Author</h3>
        </div>
    </div>
    <!-- End Page Header -->

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif($message = Session::get('fail'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

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
                            <th>No. Invoice</th>
                            <th>ID Paper</th>
                            <th>Title</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr>
                        <td></td>
                        <td>{{@$data->invoicepaper->no_invoice}}</td>
                        <td>{{$data->id}}</td>
                        <td>{{$data->title}}</td>
                        <td class="text-center">{{StatusReregistrationPaper($data->id)}}</td>
                        @if ($data->date_reregist == NULL)
                        <td class="text-center">
                            <form method="POST" action="{{route('reregistration.post')}}">
                            @csrf
                                <input type="hidden" name="id" value="{{$data->id}}">
                            <button type="submit" class="btn btn-accent" title="Registered"><i class="material-icons">check</i></button>
                            </form>
                        </td>
                        @else
                        <td class="text-center"></td>
                        @endif


                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@endsection
