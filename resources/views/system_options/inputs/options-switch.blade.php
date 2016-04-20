{{--<div class="box-header with-border">--}}
    {{--<label><h3 class="box-title">{{$option->name}}</h3></label>--}}
    {{--<div>--}}
        {{--<input type="radio" name="{{$option->key}}" value="on" {{$valueFromDb == 'on' ? 'checked' : ''}}>on--}}
        {{--<input type="radio" name="{{$option->key}}" value="off" {{$valueFromDb == 'off' ? 'checked' : ''}}>off--}}
    {{--</div>--}}
    {{--<div class="help-block">{{$option->description}}</div>--}}
{{--</div>--}}
<div class="box-header">
    <label><h3 class="box-title">{{$option->name}}</h3></label>
<div title=".slideThree">
    <!-- .slideThree -->
    <div class="slideThree">
        <input type="checkbox" value="on" id="{{$option->key}}slide" name="{{$option->key}}" {{$valueFromDb == 'on' ? 'checked' : ''}} />
        <label for="{{$option->key}}slide"></label>
    </div>
    <!-- end .slideThree -->
</div>
    <div class="help-block">{{$option->description}}</div>
</div>