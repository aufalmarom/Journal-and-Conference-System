@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Publication Section</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('lp.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if($message = Session::get('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="card card-small mb-4">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item p-3">
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                      <form method="POST" action="{{route('publication.post')}}">
                        @csrf
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group text-center">
                                        <strong class="text-muted d-block mb-2">Publication Name</strong>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group text-center">
                                        <strong class="text-muted d-block mb-2">Link</strong>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group text-center">
                                        <strong class="text-muted d-block mb-2">Delete</strong>
                                    </div>
                                </div>
                            </div>

                            @foreach ($datas as $data)
                            <div class="row loadData{{$data->id}}">
                                <input type="hidden" name="id[]" value="{{$data->id}}">
                                <input id="status-{{$data->id}}" type="hidden" name="status[]" value="simpan">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <input type="text" name="name[]" class="form-control" placeholder="name" value="{{$data->name}}" required>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <input type="text" name="link[]" class="form-control" placeholder="Link Web" value="{{$data->link}}" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group text-center">
                                        <button type="button" onclick="loadData({{$data->id}})" class="btn btn-danger">-</button>
                                    </div>
                                </div>
                            </div>

                            @endforeach


                            <div class="invisible">
                                <a id="room">{{@$data->id+1}}</a>
                            </div>
                            <div id="dynamic_form">

                            </div>
                            <div class="row text-left">
                                <div class="col-sm-6">
                                    <button type="button" onclick="dynamic()" class="mb-2 btn btn-primary mr-2">Add Data</button>

                                    <button type="submit" class="mb-2 btn btn-primary mr-2">Save</button>
                                </div>
                            </div>
                            <script>
                                function loadData(rid) {
                                $('.loadData'+rid).attr('style','display:none');
                                $('#status-'+rid).val('hapus');
                                }
                                function remove_dynamic(rid) {
                                $('.removeclass'+rid).remove();
                                }

                                function dynamic() {
                                    var room = $('#room').text();
                                    var objTo = document.getElementById('dynamic_form');
                                    var divtest = document.createElement("div");
                                    divtest.setAttribute("class", "row removeclass"+room);
                                    divtest.innerHTML = '<div class="col-sm-5"><div class="form-group"><input type="text" name="name[]" class="form-control" id="validationServer03" placeholder="Logo" required></div></div><div class="col-sm-5"><div class="form-group"><input type="text" name="link[]" class="form-control" placeholder="Link Web" value="{{$data->link}}" required></div></div><div class="col-sm-2"><div class="form-group text-center"><button type="button" onclick="remove_dynamic(' + room + ')" class="btn btn-danger">-</button></div></div>';

                                    objTo.appendChild(divtest);

                                    var roomNew = parseInt(room)+1;
                                        $('#room').text(roomNew);
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
