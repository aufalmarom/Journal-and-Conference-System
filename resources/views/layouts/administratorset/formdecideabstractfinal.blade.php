@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Form Decide Presentation</h3>
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
            <a class="btn btn-accent" href="{{route('abstractfinalundecideadministrator.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
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
                                <label>Title : {{$abstract_final->submissions->title}} </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Topic : {{$abstract_final->submissions->topics->title}} </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Author want Presentation : {{$abstract_final->submissions->presentation}} </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Abstract Final :</label>
                                <textarea disabled="disabled" rows="100" class="ckeditor" name="ck_input" id="editor" required>{{$abstract_final->abstract_final}}</textarea>
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
        @foreach ($data_assigned as $data)
        <div class="col-lg-4">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Suggested from Reviewer {{$no}} : {{$data->user->name}}</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                        @for ($i = 0; $i < count($data->abstractfinaldecision); $i++)
                        @if ($data->id_reviewer == $data->abstractfinaldecision[$i]->id_reviewer)
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>{{$data->abstractfinaldecision[$i]->presentation}}</label>
                            </div>
                        </div>
                        @else
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Reviewer not yet send suggestion.</label>
                            </div>
                        </div>
                        @endif
                        @endfor
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
                        <form method="POST" action="{{route('abstractfinalundecideadministrator.send')}}">
                            @csrf
                            <input type="hidden" name="id_paper" value="{{$abstract_final->id_paper}}">
                                <button type="submit" class="btn btn-accent" name="presentation" value="Poster"">Poster Presentation</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-danger" name="presentation" value="Oral">Oral Presentation</button>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
            </div>
        </div>
    </div>




@endsection
