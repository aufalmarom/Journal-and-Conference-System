@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Full Paper Underview</h3>
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
                        <th class="text-center">Full Paper Underview</th>
                        <th class="text-center">Full Paper Underview Reviewed</th>
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
                    @for ($i = 0; $i < count($data->paperunderview); $i++)
                    @if ($data->id == $data->paperunderview[$i]->id_paper)
                    <td class="text-center">
                        <a class="btn btn-accent" title="Download Full Paper Underview" href="{{route('downloadpaperunderview', $data->paperunderview[$i]->id_paper)}}"><i class="material-icons">archive</i></a>
                    </td>
                    @endif
                    @endfor
                    @for ($i = 0; $i < count($data->paperunderviewreview); $i++)
                    @if ($data->id == $data->paperunderviewreview[$i]->id_paper)
                    <td class="text-center">
                        <a class="btn btn-accent" title="Download Full Paper Underview Review" href="{{route('downloadpaperunderviewreview', $data->paperunderviewreview[$i]->id_paper)}}"><i class="material-icons">archive</i></a>
                    </td>
                    @endif
                    @endfor
                    <td>
                            @if ($data->date_ppt == NULL)
                            <form method="POST" action="{{route('formpowerpoint.read')}}">
                            @csrf
                                <input type="hidden" name="id_paper" value="{{$data->id}}">
                                <button class="btn btn-accent" type="submit" title="Send Powerpoint"><i class="material-icons">description</i></button>
                            </form>
                            @else
                            -
                            @endif
                            <br>
                    {{-- @if ($data->date_paper_underview == NULL) --}}
                    <form method="POST" action="{{route('formfullpapercameraready.read')}}">
                    @csrf
                        <input type="hidden" name="id_paper" value="{{$data->id}}">
                        <button class="btn btn-accent" type="submit" title="Send Paper Camera Ready"><i class="material-icons">send</i></button>
                    </form>
                    <br>
                    {{-- @else --}}
                        {{-- - --}}
                    {{-- @endif --}}

                    </td>
                    </tr>


                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>

@endsection
