@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Total Powerpoints</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('dashboard')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Dashboard</a>
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
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td></td>
                    <td>{{$data->submissions->title}}</td>
                    <td>{{TeamPaper($data->submissions->team_code)}}</td>
                    @for ($i = 0; $i < count($data->submissions->ppt); $i++)
                    @if ($data->submissions->id == $data->submissions->ppt[$i]->id_paper)
                    <td class="text-center">
                        <a class="btn btn-accent" title="Download Powerpoint" href="{{route('downloadppt', $data->submissions->ppt[$i]->id_paper)}}"><i class="material-icons">archive</i></a>
                    </td>
                    @endif
                    @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

   @endsection
