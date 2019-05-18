@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Reviewer</h3>
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
            <a class="btn btn-accent" href="{{route('dashboard')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Dashboard</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-6">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Add Reviewer</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                    <div class="row">
                        <div class="col">
                        <form method="POST" action="{{route('reviewer.post')}}">
                        @csrf
                            <input type="hidden" name="role" value="2">
                            <input type="hidden" name="password" value="{{RandomString()}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name Reviewer">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email Reviewer">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-accent">Add Data</button>
                        </form>
                        </div>
                    </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table id="myTable" class="ui celled table" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td></td>
                    <td>{{$data->user->name}}</td>
                    <td>{{$data->user->email}}</td>
                    <td class="text-center">{{StatusAllReviewer($data->user->id)}}</td>
                    <form method="POST" action="{{route('reviewer.delete')}}">
                            @csrf
                        <td class="text-center">
                            <input  type="hidden" name="id" value="{{$data->user->id}}">
                            <button type="submit" class="btn btn-danger" title="Delete Reviewer"><i class="material-icons">delete</i></button>
                        </td>
                    </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>

@endsection
