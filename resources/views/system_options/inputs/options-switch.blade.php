<div class="box-header with-border">
    <h3 class="box-title">{{$option->name}}</h3>
</div>
<input type="checkbox" class="checkbox-options" {{$option->value == 1?'checked':''}} name="{{$option->key}}">


