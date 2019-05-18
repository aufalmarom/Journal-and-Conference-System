@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Assign to Reviewer</h3>
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
            <div class="col-lg-12">
                <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Meta Data Paper</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                    <div class="row">
                        <div class="col">
                        <form method="POST" action="{{route('assigntoreviewer.post')}}">
                        @csrf
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Title : {{$data->title}}</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Topic : {{$data_topic->title}}</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Authors : </label>
                                    <br>
                                <label>{{TeamPaper($data->team_code)}}</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Reviewer</label>
                                    <select class="form-control" name="reviewer[]" required>
                                        <option selected=""">Choose Reviewer</option>
                                        @foreach ($reviewer1 as $r1)
                                        <option value="{{$r1->id_user}}">{{$r1->user->name}}</option>
                                        @endforeach
                                        @foreach ($reviewer2 as $r2)
                                        <option value="{{$r2->id_user}}">{{$r2->user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="invisible">
                                <a id="room">{{@$data->id+1}}</a>
                            </div>

                            <div id="dynamic_form">
                            </div>
                                <p class="small">*reviewer min 1 and max 3</p>
                            <div class="row text-left">
                                <div class="col-sm-6">
                                    <button type="button" onclick="dynamic()" class="mb-2 btn btn-primary mr-2">Add Reviewer</button><br>
                                    <button type="submit" class="btn btn-accent">Submit Paper</button>
                                </div>
                            </div>

                            <div class="invisible">
                                <a id="max_author">1</a>
                            </div>

                            <script>
                                function remove_dynamic(rid) {
                                    $('.removeclass'+rid).remove();
                                    var max_author = $('#max_author').text();
                                        $('#max_author').text(parseInt(max_author)-1);
                                }
                                function dynamic() {
                                    var max_author = $('#max_author').text();
                                    if (max_author == 3) {
                                        alert('Reviewer Maximal 3');
                                    }else{
                                        var room = $('#room').text();
                                        var objTo = document.getElementById('dynamic_form');
                                        var divtest = document.createElement("div");
                                        divtest.setAttribute("class", "row removeclass"+room);
                                        divtest.innerHTML = '<div class="form-group col-md-10"><select class="form-control" name="reviewer[]" required><option selected=""">Choose Reviewer</option>@foreach ($reviewer1 as $r1)<option value="{{$r1->id_user}}">{{$r1->user->name}}</option>@endforeach @foreach ($reviewer2 as $r2)<option value="{{$r2->id_user}}">{{$r2->user->name}}</option>@endforeach</select></div></div><div class="form-group col-md-2"><button type="button" onclick="remove_dynamic(' + room + ')" class="btn btn-danger">-</button></div>';
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
