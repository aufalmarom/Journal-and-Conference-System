@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Edit Paper</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Meta Data Paper</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                    <form method="POST" action="{{route('editabstractsubmitted.post')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Title*</label>
                                <input type="text" class="form-control" name="title" placeholder="Title" value="{{$data->title}}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Topics*</label>
                                <select class="form-control" name="topic" required>
                                    @foreach ($data_topics as $dat)
                                    <option value="{{$dat->id}}"
                                        @if ($dat->id == $data->topic)
                                        selected="selected"
                                        @endif>{{$dat->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Poster or Abstract*<p class="small">(can change according to scientific committe)</p></label>
                                <select class="form-control" name="presentation" required>

                                    <option value="poster"
                                    @if ($data->presentation == "poster")
                                            selected="selected"
                                            @endif>Poster</option>
                                    <option value="abstract"
                                    @if ($data->presentation == "abstract")
                                            selected="selected"
                                            @endif>Abstract</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Abstract*</label>
                                <textarea rows="100" class="ckeditor" name="ck_input" id="editor" required>{{$data->abstract}}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Keywords*</label>
                            <input type="text" class="form-control" name="keywords" placeholder="insert keywords" value="{{$data->keywords}}" required>
                            </div>
                        </div>

                        <div class="row text-left">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-accent">Submit Paper</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>
    </div>



@endsection
