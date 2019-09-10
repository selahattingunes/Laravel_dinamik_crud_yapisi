<?php if (empty($data["index"])){echo "dinamik_crud index bölümünde hata oluştu !"; exit;} ?>

<table>
    <thead>
    <tr>
        @foreach($data["index"]["table"] as $key => $value)
            <th>{{$value}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($data["index"]["items"] as $key => $value)
            <tr>
                @foreach($data["index"]["table"] as $key_column =>$value_column)
                    <td>{{$value->$key_column}}</td>
                @endforeach
            </tr>
        @endforeach
        @if($data["index"]["items"]->links())
            {{$data["index"]["items"]->render()}}
        @endif
    </tbody>
</table>