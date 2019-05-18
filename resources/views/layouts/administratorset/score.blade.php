@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Evaluation - Score System</h3>
        </div>
    </div>
    <!-- End Page Header -->
    @if($message = Session::get('success_score'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('evaluationsystem.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Evaluation System</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Add Score Criteria</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('score.post')}}">
                        @csrf
                        <input type="hidden" name="id_evaluation" value="{{$data->id}}">
                        @php
                            $no = 1;
                        @endphp
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                <label class="bmd-label-floating">Score</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                <label class="bmd-label-floating">Note</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Delete</label>
                                </div>
                            </div>

                        </div>

                        @foreach ($datas as $data)

                        <div class="row removeclass{{$no}}">
                            <div class="col-md-5">
                                <div class="form-group">
                                <input type="number" name="score[]" class="form-control" placeholder="score" value="{{$data->score}}" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                <input type="text" name="note[]" class="form-control" placeholder="note" value="{{$data->note}}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="button" onclick="remove_dynamic({{$no}})" class="btn btn-danger">-</button>
                                </div>
                            </div>
                        </div>
                        @php
                            $no++;
                        @endphp

                        @endforeach

                        <div class="invisible">
                            <a id="room">{{@$no}}</a>
                        </div>


                        <div id="dynamic_form">
                        </div>

                        <script type="text/javascript">
                            function dynamic() {
                                var room = $('#room').text();
                                var objTo = document.getElementById('dynamic_form');
                                var divtest = document.createElement("div");
                                divtest.setAttribute("class", "row removeclass"+room);
                                var stress= "'";
                                divtest.innerHTML = '<div class="col-md-5"><div class="form-group"><input type="number" name="score[]" class="form-control" placeholder="score" required></div></div><div class="col-md-5"><div class="form-group"><input type="text" name="note[]" class="form-control" placeholder="note" required></div></div><div class="col-md-2"><div class="form-group"><button type="button" onclick="remove_dynamic(' + room + ')" class="btn btn-danger">-</button></div></div>';

                                objTo.appendChild(divtest);

                                room++;
                                $('#room').text(parseInt(room));
                            }
                            function remove_dynamic(rid) {
                                $('.removeclass'+rid).remove();
                            }
                        </script>
                        <button type="btn" class="btn btn-accent" onclick="dynamic()">Add Data</button>
                        <button type="submit" class="btn btn-accent">Save Data</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br>

@endsection
