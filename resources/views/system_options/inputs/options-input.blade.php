<div class="box-header {{ $errors->has($option->key) ? 'has-error' : '' }}">
    <label><h3 class="box-title">{{$option->name}}</h3></label>
    <input class="form-control input-lg" type="text" name="{{$option->key}}" value="{{$option->value}}" placeholder="{{$option->value}}">
    <span class="help-block">{{ $errors->first($option->key, ':message') }}</span>
    <div class="help-block">{{$option->description}}</div>
</div>