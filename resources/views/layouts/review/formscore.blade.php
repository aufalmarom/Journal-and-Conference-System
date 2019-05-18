@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Abstract To Score</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('abstracttoscore.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
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
                                <label>Title : {{$data->title}}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Topic : {{$data->topics->title}}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea disabled="disabled" rows="100" class="ckeditor" name="ck_input" id="editor" required>{{$data->abstract}}</textarea>
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
        <div class="col-lg-8">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Scores Form</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                    <form method="POST" action="{{route('abstracttoscore.post')}}">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="id_paper" value="{{$data->id}}">
                                @foreach ($criteria as $data)
                                    @php
                                        $label = str_replace(' ','',$data->label);
                                    @endphp
                                    <div class="invisible">
                                        <a id="{{$label}}" class="score">0</a>
                                    </div>
                                    <label>{{$data->label}}</label> <br>
                                    <input type="hidden" name="id_criteria[]" value="{{$data->id}}">
                                    @foreach ($score as $data1)
                                    @if ($data1->id_evaluation == $data->id)
                                    <div class="custom-radio mb-1">
                                        <input type="radio" onclick="Recommendation({{$data1->score}}, '{{$label}}')" value="{{$data1->score}}" name="score_{{$data->id}}" required>
                                        <label class="custom-control-label">{{$data1->score}} : {{$data1->note}}</label>
                                    </div>

                                    @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label><a id = "FinalRekomendasi">Recommendation</a> : <a id = "Rekomendasi">0</a></label>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-accent">Send Score</button>
                            </div>
                        </div>
                    </form>
                    <div class="invisible">
                        @foreach ($score_rekomendasi as $item)
                            <a id="note_{{$item->score}}">{{$item->note}}</a>
                        @endforeach

                    </div>

                    <script>
                        function Recommendation(id,label){
                           $('#'+label).text(id);
                           var sum = 0;
                            $('.score').each(function(){
                                sum += parseFloat($(this).text());
                            })
                            var rekomendasi = Math.round(sum/4-0.1);
                            $('#Rekomendasi').text(rekomendasi);
                            var final = $('#note_'+rekomendasi).text();
                            $('#FinalRekomendasi').text(final);


                        }
                    </script>
                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>
    </div>



@endsection
