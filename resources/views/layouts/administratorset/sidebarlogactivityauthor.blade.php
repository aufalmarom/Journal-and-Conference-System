@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Log Activity Author</h3>
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
                        <th>Activity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($datas as $data)
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
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
    <br>

@endsection
