<?php
if (  empty($data["index"])  ){
    if (  empty($data["index"]["table"]) ||  $data["index"]["items"]  ){
        echo "dinamik_crud index bölümünde hata oluştu !";
        exit;
    }
} ?>

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
                <td>
                    <form action="{{$data["other"]["root_page_link"]."/destroy"}}" method="post">
                        @csrf @method("delete")
                        <input type="hidden" name="id" value="{{$value->id}}">
                        <input type="submit" value="Sil">
                    </form>

                </td>
            </tr>
        @endforeach
        {{$data["index"]["items"]->links()}}
    </tbody>
</table>
<a href="{{$data["other"]["root_page_link"]."/create"}}">Yeni Ekle</a>