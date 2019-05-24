@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Abstract Submitted</h3>
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
            <a class="btn btn-accent" href="{{route('dashboard')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Dashboard</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col">
            <table id="myTable" class="ui celled table" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Authors</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td></td>
                    <td>{{$data->title}}</td>
                    <td>
                    @for ($i = 0; $i < count($data->team); $i++)
                        {{@$data->team[$i]->user->name}}<br>
                    @endfor
                    </td>
                    <td class="text-center">{{StatusPaper($data->id)}}</td>
                    @if (StatusPaper($data->id) == 'Rejected')
                    <td class="text-center">
                        -
                    </td>
                    @elseif(StatusPaper($data->id) == 'Accepted')
                    <td class="text-center">
                        @if (@$data->invoicepaper->status_payment == NULL)
                        <p>Finish paper payment!</p>
                        @else
                        <p>Save Payment!</p>
                        @endif
                        <form action="{{route('invoicepaper')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                            <button type="submit" class="btn btn-accent" title="Invoice"><i class="material-icons">payment</i></button>
                        </form>
                    </td>
                    @elseif($data->date_decide == NULL)
                    <td class="text-center">
                        -
                    </td>
                    @elseif($data->date_invoice == NULL)
                    <td class="text-center">
                        -
                    </td>
                    @else
                    <td class="text-center">
                        <form method="POST" action="{{route('abstractsubmitted.edit')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <button type="submit" class="btn btn-accent" title="Edit Abstract"><i class="material-icons">edit</i></button>
                        </form>

                        <br>
                        <form method="POST" action="{{route('abstractsubmitted.delete')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <button type="submit" class="btn btn-danger" title="Delete Abstract"><i class="material-icons">delete</i></button>
                        </form>
                    </td>
                    @endif

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>

@endsection
