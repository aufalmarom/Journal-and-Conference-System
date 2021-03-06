@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Key Notes Section</h3>
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
                  <form method="POST" action="{{route('keynotes.post')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group text-center">
                                    <strong class="text-muted d-block mb-2">Photos</strong>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group text-center">
                                    <strong class="text-muted d-block mb-2">Key Notes Name</strong>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group text-center">
                                    <strong class="text-muted d-block mb-2">Sector</strong>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group text-center">
                                    <strong class="text-muted d-block mb-2">Descriptions</strong>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group text-center">
                                    <strong class="text-muted d-block mb-2">Delete</strong>
                                </div>
                            </div>
                        </div>

                        @foreach ($datas as $data)
                        <div class="row loadData{{$data->id}}">
                            <input type="hidden" name="id[]" value="{{$data->id}}">
                            <input id="status-{{$data->id}}" type="hidden" name="status[]" value="simpan">
                            <div class="col-sm-3">
                                <div class="form-group custom-file">
                                    <input type="file" name="photo[]" class="custom-file-input">
                                        <label class="custom-file-label">{{$data->photo}}</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" name="name[]" class="form-control" placeholder="Key Notes" value="{{$data->name}}" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" name="sector[]" class="form-control" placeholder="Sector" value="{{$data->sector}}" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input type="text" name="description[]" class="form-control" placeholder="Desc" value="{{$data->description}}" required>
                                </div>
                            </div>
                            <div class="col-sm-1">
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

                        <p class="small">*ideal size photo 1:1, max size : 100KB</p>
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
                                divtest.innerHTML = '<div class="col-sm-3"><div class="form-group custom-file"><input type="hidden" name="id[]"><input type="file" class="custom-file-input" name="photo[]" required><label class="custom-file-label"></label></div></div><div class="col-sm-3"><div class="form-group"><input type="text" name="name[]" class="form-control" placeholder="name" required></div></div><div class="col-sm-3"><div class="form-group"><input type="text" name="sector[]" class="form-control" placeholder="sector" required></div></div><div class="col-sm-2"><div class="form-group"><input type="text" name="description[]" class="form-control" placeholder="description" required></div></div><div class="col-sm-1"><div class="form-group text-center"><button type="button" onclick="remove_dynamic(' + room + ')" class="btn btn-danger">-</button></div></div>';

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
