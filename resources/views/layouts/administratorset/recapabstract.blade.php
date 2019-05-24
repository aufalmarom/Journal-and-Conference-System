<table>
    <thead>
        <tr>
            <th>Topics</th>
            <th>Title</th>
            <th>Keywords</th>
            <th>Authors</th>
            <th>Reviewers</th>
            <th>Presentation</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
        <td>{{$data->topics->title}}</td>
        <td>{{$data->title}}</td>
        <td>{{$data->keywords}}</td>
        <td>{{TeamAbstract($data->team_code)}}</td>
        <td>
            @for ($i = 0; $i < count($data->reviewer); $i++)
                {{$data->reviewer[$i]->user->name.", "}}
            @endfor
        </td>
        <td>{{$data->presentation}}</td>
        <td>{{$data->status_paper}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
