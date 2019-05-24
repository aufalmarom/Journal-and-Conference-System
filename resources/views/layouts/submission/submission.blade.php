@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Submission</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('dashboard')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Dashboard</a>
        </div>
    </div>
    <br>

    @if (Auth::user()->auth_info->id_user == NULL)

    @php

    @endphp

    @endif

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
                    <form method="POST" action="{{route('submission.post')}}">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Title*</label>
                                <input type="text" class="form-control" name="title" placeholder="Title" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Topics*</label>
                                <select class="form-control" name="topic" required>
                                    <option selected="" value="">Choose Topic</option>
                                    @foreach ($data_topics as $data)
                                    <option value="{{$data->id}}">{{$data->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Publication at*</label>
                                <select class="form-control" name="publication" required>
                                    <option selected="" value="">Choose Publication</option>
                                    @foreach ($data_publication as $data)
                                    <option value="{{$data->id}}">{{$data->publication_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Poster Presentation or Oral Presentation*<p class="small">(can change according to scientific committe)</p></label>
                                <select class="form-control" name="presentation" required>
                                    <option selected="" value="">Choose One...</option>
                                    <option value="poster">Poster Presentation</option>
                                    <option value="oral">Oral Presentation</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Abstract*</label>
                                <textarea rows="100" class="ckeditor" name="ck_input" id="editor" required></textarea>
                                <p class="small-text">Full English</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Keywords*</label>
                            <input type="text" class="form-control" name="keywords" placeholder="insert keywords" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Author*</label>
                            <input type="text" disabled="disabled" class="form-control" name="Author" placeholder="choose one" value="{{Auth::user()->name}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Email*</label>
                            <input type="email" disabled="disabled" class="form-control" name="email" placeholder="email" value="{{Auth::user()->email}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Telp*</label>
                            <input type="number" class="form-control" name="phone" placeholder="telp" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label>Author*</label>
                                <input type="text" class="form-control" name="name[]" placeholder="Name" required>
                            </div>
                            <div class="form-group col-md-5">
                                    <label>Email*</label>
                                <input type="email" class="form-control" name="email[]" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="invisible">
                            <a id="room">{{@$data->id+1}}</a>
                        </div>

                        <div id="dynamic_form">
                        </div>

                        <p class="small">*author min 2 and max 5 </p>

                        <div class="row text-left">
                            <div class="col-sm-6">
                                <button type="button" onclick="dynamic()" class="mb-2 btn btn-primary mr-2">Add Author</button><br>
                                <button type="submit" class="btn btn-accent">Submit Paper</button>
                            </div>
                        </div>

                        <div class="invisible">
                            <a id="max_author">1</a>
                        </div>

                        <script>
                            function loadData(rid) {
                                $('.loadData'+rid).attr('style','display:none');
                            }
                            function remove_dynamic(rid) {
                                $('.removeclass'+rid).remove();
                                var max_author = $('#max_author').text();
                                    $('#max_author').text(parseInt(max_author)-1);
                            }
                            function dynamic() {
                                var max_author = $('#max_author').text();
                                if (max_author == 4) {
                                    alert('Author Maximal 5');
                                }else{
                                    var room = $('#room').text();
                                    var objTo = document.getElementById('dynamic_form');
                                    var divtest = document.createElement("div");
                                    divtest.setAttribute("class", "row removeclass"+room);
                                    divtest.innerHTML = '<div class="form-group col-md-5"><input type="text" class="form-control" name="name[]" placeholder="Name" required></div><div class="form-group col-md-5"><input type="email" class="form-control" name="email[]" placeholder="Email" required></div><div class="form-group col-md-2"><button type="button" onclick="remove_dynamic(' + room + ')" class="btn btn-danger">-</button></div>';
                                    objTo.appendChild(divtest);
                                    var roomNew = parseInt(room)+1;
                                    $('#room').text(roomNew);
                                    $('#max_author').text(parseInt(max_author)+1);
                                }
                            }
                        </script>
                    </form>
                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>
    </div>



@endsection
