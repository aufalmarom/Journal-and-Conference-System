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
        <div class="col-lg-4">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Scores Form Reviewer 1</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                    <br>
                                @foreach ($score as $data)
                                    <div class="custom-radio mb-1">
                                        <label class="custom-control-label"> {{$data->evaluation->label}} = {{$data->score}} : {{Note($data->id_evaluation, $data->score)}} </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Recommendation : {{$nilai_rekomendasi}} : {{NoteRecommendation($nilai_rekomendasi)}} </label>
                            </div>
                        </div>
                    </div>
                </div>

                </li>
            </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Scores Form Reviewer 2</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <br>
                                @foreach ($score as $data)
                                    <div class="custom-radio mb-1">
                                        <label class="custom-control-label"> {{$data->evaluation->label}} = {{$data->score}} : {{Note($data->id_evaluation, $data->score)}} </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Recommendation : {{$nilai_rekomendasi}} : {{NoteRecommendation($nilai_rekomendasi)}} </label>
                            </div>
                        </div>
                    </div>
                </div>

                </li>
            </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Scores Form Reviewer 3</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <br>
                                @foreach ($score as $data)
                                    <div class="custom-radio mb-1">
                                        <label class="custom-control-label"> {{$data->evaluation->label}} = {{$data->score}} : {{Note($data->id_evaluation, $data->score)}} </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Recommendation : {{$nilai_rekomendasi}} : {{NoteRecommendation($nilai_rekomendasi)}} </label>
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
                            <input type="hidden" name="id_paper" value="{{$score[0]->id_paper}}">
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
