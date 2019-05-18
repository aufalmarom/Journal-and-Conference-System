@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Review Abstract Reviewed</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('dashboard')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Dashboard</a>
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

    @if ($message = Session::get('fail'))
    <div class="alert alert-fail alert-dismissible fade show" role="alert">
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
                            <th>Title</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($datas as $data)
                        <tr>
                        <td></td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td class="text-center">{{StatusAllReviewer($data->id)}}</td>
                        <form method="POST" action="{{route('reviewer.delete')}}">
                                @csrf
                            <td class="text-center">
                                <input  type="hidden" name="id" value="{{$data->id}}">
                                <button type="submit" class="btn btn-danger" title="Delete Reviewer"><i class="material-icons">delete</i></button>
                            </td>
                        </form>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
        <br>





@endsection
