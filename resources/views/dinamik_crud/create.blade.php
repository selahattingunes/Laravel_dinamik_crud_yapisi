<form action="{{route($form["route_name"],$form["route_values"])}}" method="{{$form["method"]}}">
    @csrf
    @foreach($postForeignKeys as $key_column => $key_value)
        <input type="hidden" name="{{$key_column}}" value="{{$key_value}}">
    @endforeach
    @foreach($inputs as $key_input => $value_input)
        @foreach($value_input["columns"] as $key_column => $value_column)
            <label for="">{{$value_column}}</label>
            @if($value_input["type"]=="radio")
                <input type="radio" name="{{$key_column}}"><br>
            @endif
            @if($value_input["type"]=="text")
                <input type="text" name="{{$key_column}}"><br>
            @endif
            @if($value_input["type"]=="select")
                    <select name="{{$key_column}}" id="">
                        <option value="">test</option>
                        <option value="">test</option>
                        <option value="">test</option>
                        <option value="">test</option>
                    </select><br>
            @endif
        @endforeach
    @endforeach
    <input type="submit" value="Ekle">
</form>