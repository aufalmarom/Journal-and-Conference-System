@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Abstract Review</h3>
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
    @elseif($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('sidebarpaper')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col">
            <table id="myTable" class="ui celled table" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Reviewers</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td></td>
                    <td>{{$data->title}}</td>
                    <td>{{TeamPaper($data->team_code)}}</td>
                    <td>
                        @for ($i = 0; $i < count($data->reviewer); $i++)
                            {{$data->reviewer[$i]->user->name}} <br>
                        @endfor
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>

@endsection
