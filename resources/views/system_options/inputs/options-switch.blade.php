<div class="box-header with-border">
    <label><h3 class="box-title">{{$option->name}}</h3></label>
    <div>
        <input type="radio" name="{{$option->key}}" value="on" {{$option->value == 'on' ? 'checked' : ''}}>on
        <input type="radio" name="{{$option->key}}" value="off" {{$option->value == 'off' ? 'checked' : ''}}>off
    </div>
    <div class="help-block">{{$option->description}}</div>
</div>
{{--<input type="checkbox" class="checkbox-options" {{$option->value == 'on' ? 'checked' : ''}} name="{{$option->key}}[]" value="off">--}}