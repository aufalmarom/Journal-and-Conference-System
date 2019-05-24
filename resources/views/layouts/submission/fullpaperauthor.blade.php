@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Full Paper</h3>
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
                        <th style="width:40%">Title</th>
                        <th>Authors</th>
                        <th>Presentation</th>
                        <th class="text-center">Full Paper</th>
                        <th>Full Paper Review</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td></td>
                    <td>{{$data->title}}</td>
                    <td>{{TeamPaper($data->team_code)}}</td>
                    <td>{{$data->presentation}}</td>
                    @for ($i = 0; $i < count($data->paper); $i++)
                    @if ($data->id == $data->paper[$i]->id_paper)
                    <td class="text-center">
                        <a class="btn btn-accent" title="Download Full Paper" href="{{route('downloadpaper', $data->paper[$i]->id_paper)}}"><i class="material-icons">archive</i></a>
                    </td>
                    @endif
                    @endfor
                    @for ($i = 0; $i < count($data->paperreview); $i++)
                    @if ($data->id == $data->paperreview[$i]->id_paper)
                    <td class="text-center">
                        <a class="btn btn-accent" title="Download Full Paper Review" href="{{route('downloadpaperreview', $data->paperreview[$i]->id_paper)}}"><i class="material-icons">archive</i></a>
                    </td>
                    @endif
                    @endfor
                    {{-- @if ($data->paper == NULL) --}}
                    <form method="POST" action="{{route('formfullpaperunderview.read')}}">
                        @csrf
                        <td>
                            <input type="hidden" name="id_paper" value="{{$data->id}}">
                            <button class="btn btn-accent" type="submit" title="Send Paper Underview"><i class="material-icons">send</i></button>
                        </td>
                    </form>
                    {{-- @else --}}
                    <td class="text-center"> - </td>

                    {{-- @endif --}}

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>

@endsection
