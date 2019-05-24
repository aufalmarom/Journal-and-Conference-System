@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Form To Decide</h3>
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
            <a class="btn btn-accent" href="{{route('abstracttodecide.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Meta Data Paper Author</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Title : {{$submission->title}} </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Topic : {{$submission->topics->title}} </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea disabled="disabled" rows="100" class="ckeditor" name="ck_input" id="editor" required>{{$submission->abstract}}</textarea>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>
    </div>

    <div class="row">
        @php
            $no = 1
        @endphp
        @foreach ($reviewer as $data)
        <div class="col-lg-4">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Score from Reviewer {{$no}} : {{$data->user->name}} </h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                        @php
                            $recomendation = 0;
                        @endphp
                        @for ($i = 0; $i < count($data->abstractscore); $i++)
                        @if ($data->id_reviewer == $data->abstractscore[$i]->id_reviewer)
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>{{$data->abstractscore[$i]->evaluation->label}} = {{$data->abstractscore[$i]->score}} : {{Note($data->abstractscore[$i]->id_evaluation, $data->abstractscore[$i]->score)}} </label>
                            </div>
                        </div>
                        @php
                            $recomendation += $data->abstractscore[$i]->score;
                        @endphp
                        @endif
                        @endfor
                        @php
                            $recomendation = round($recomendation/4, 0, PHP_ROUND_HALF_DOWN)
                        @endphp
                        @if ($recomendation != 0)
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Recommendation = {{$recomendation}} : {{NoteRecommendation($recomendation)}} </label>
                            </div>
                        </div>
                        @else
                        'Reviewer not yet send Scores'
                        @endif
                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>
        @php
            $no++;
        @endphp

        @endforeach
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom text-center">
                <h6 class="m-0">Decision</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                    <div class="row text-center">
                            <div class="col-sm-6">

                        <form method="POST" action="{{route('formdecide.post')}}">
                            @csrf
                            <input type="hidden" name="id_paper" value="{{$submission->id}}">
                                <button type="submit" class="btn btn-accent" name="status_paper" value="accept"">Accept</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-danger" name="status_paper" value="reject">Reject</button>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
            </div>
        </div>
    </div>




@endsection
