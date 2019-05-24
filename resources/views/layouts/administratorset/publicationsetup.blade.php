@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Publication Setup</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('dashboard')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Dashboard</a>
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
    @elseif($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Publication</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                    <div class="row">
                        <div class="col">
                        <form method="POST" action="{{route('publicationsetup.post')}}">
                        @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="publication_name" placeholder="Publication name">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-accent">Add Data</button>
                        </form>
                        </div>
                    </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">List Publication</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                        <th scope="col" class="border-0">No</th>
                        <th scope="col" class="border-0">Publication</th>
                        <th scope="col" class="border-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($datas as $data)
                        <tr>
                        <td>{{$no}}</td>
                        <td>{{$data->publication_name}}</td>
                        <form method="POST" action="{{route('publicationsetup.delete')}}">
                            @csrf
                            <td>
                                <input  type="hidden" name="id" value="{{$data->id}}">
                                <button type="submit" class="btn btn-danger"><i class="material-icons">delete</i></button>
                            </td>
                        </form>
                        </tr>
                        @php
                            $no++;
                        @endphp
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
