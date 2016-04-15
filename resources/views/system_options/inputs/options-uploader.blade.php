<div class="box-header with-border {{ $errors->has($option->key) ? 'has-error' : '' }}">
    <label><h3 class="box-title">{{$option->name}}</h3></label>
    <input type="file" name="{{$option->key}}" value="{{$valueFromDb}}">
    <span class="help-block">{{ $errors->first($option->key, ':message') }}</span>
</div>
<div class="help-block">{{$option->description}}</div>