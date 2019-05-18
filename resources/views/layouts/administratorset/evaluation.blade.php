@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Evaluation System</h3>
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
    @elseif($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Add Scoring Criteria</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                    <div class="row">
                        <div class="col">
                        <form method="POST" action="{{route('evaluationsystem.post')}}">
                        @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label>Label</label>
                                <input type="text" class="form-control" name="label" placeholder="Label">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label>Prompt</label>
                                <input type="text" class="form-control" name="prompt" placeholder="Prompt">
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
                        <th>Label</th>
                        <th>Prompt</th>
                        <th width="15%">Scores</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td></td>
                    <td>{{$data->label}}</td>
                    <td>{{$data->prompt}}</td>
                    <td>
                        @foreach ($datas_score as $data_score)
                            @if ($data->id == $data_score->id_evaluation)

                            {{$data_score->score}} : {{$data_score->note}} <br>

                            @endif
                        @endforeach
                    </td>
                    <td class="text-center">
                        <a href="{{route('score.read', $data->id)}}">
                            <button type="submit" class="btn btn-accent" title="Add Score"><i class="material-icons">edit</i></button>
                        </a>
                        <br><br>
                        <form method="POST" action="{{route('evalscore.delete')}}">
                            @csrf
                            <input  type="hidden" name="id" value="{{$data->id}}">
                            <button type="submit" class="btn btn-danger" title="Delete Reviewer"><i class="material-icons">delete</i></button>
                        </form>

                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>

@endsection
