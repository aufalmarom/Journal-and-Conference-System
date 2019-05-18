@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Abstract Unscored</h3>
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
                        <th style="width:20%">Authors</th>
                        <th style="width:20%">Reviewers</th>
                        <th class="text-center" style="width:15%">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td></td>
                    <td>{{$data->title}}</td>
                    <td>
                    @for ($i = 0; $i < count($data->team); $i++)
                        {{$data->team[$i]->user->name}}<br>
                    @endfor
                    </td>
                    <td>
                    @for ($i = 0; $i < count($data->assignedabstract); $i++)
                        {{$data->assignedabstract[$i]->user->name}}<br>
                    @endfor
                    </td>
                    <td class="text-center">{{StatusAbstract($data->id)}}</td>

                    <td class="text-center">
                        <a href="{{route('abstractunscored.edit', $data->id)}}">
                        <button type="submit" class="btn btn-accent" title="Edit Abstract"><i class="material-icons">edit</i></button>
                        </a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>

@endsection
