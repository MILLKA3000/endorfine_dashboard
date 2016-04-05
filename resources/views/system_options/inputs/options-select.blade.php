<div class="box-header">

    <label><h3 class="box-title">{{$option->name}}</h3></label>
    <select name="{{$option->key}}" class="form-control">
        @foreach(json_decode($option->options) as $key => $value)
            <option {{$value->name == $option->value ? 'selected' : ''}}>{{$value->name}}</option>
        @endforeach
    </select>
    ____________________________________________
</div>
