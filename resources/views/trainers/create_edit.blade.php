@extends('layouts.app')
{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Тренер
            <div class="pull-right">
                <div class="pull-right">

                </div>
            </div>
        </h3>
    </div>
@if (isset($trainer))
{!! Form::model($trainer, array('url' => URL::to('trainers') . '/' . $trainer->id, 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => URL::to('$trainers'), 'method' => 'UPDATE', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="row">
            <div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name', 'Ім\'я', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                </div>
                <span class="help-block">Ім'я тренера</span>
            </div>
            <div class="form-group col-md-6 {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('email', 'Email', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('email', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                </div>
                <span class="help-block">E-mail повинен бути в домені <b>xxx@gmail.com</b> і також повинен бути присутній календар тренувань для даного тренера. <a href="#">Детальніше...</a></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('password', 'Пароль', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::password('password', array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                </div>
                <span class="help-block">Введіть пароль для тренера він зможе авторизовуватись в системі "MyTraining"</span>
            </div>
            <div class="form-group col-md-6 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                {!! Form::label('password_confirmation', 'Пароль повторіть', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('password_confirmation', ':message') }}</span>
                </div>
                <span class="help-block">Введіть пароль ще раз</span>
            </div>
        </div>
        <div class="row">

            <div class="form-group col-md-6 hidden{{ $errors->has('role_id') ? 'has-error' : '' }}">
                {!! Form::label('role_id', 'Роль', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('role_id', $roles->lists('name', 'id'), (isset($user))?$user->getNameRole->id:'',array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('role_id', ':message') }}</span>
                </div>
            </div>

            <div class="form-group col-md-6 {{ $errors->has('min') ? 'has-error' : '' }}">
                {!! Form::label('min', 'Мінімальна ставка за одне заняття', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('min', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('min', ':message') }}</span>
                </div>
                <span class="help-block">Дана ставка буде отримана тренером в будь-якому випадку, навіть якщо тренування не відбулося </span>
            </div>

            <div class="form-group col-md-6 {{ $errors->has('payment_id') ? 'has-error' : '' }}">
                {!! Form::label('payment_id', 'Тип контракту', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('payment_id', array_merge([0=>'Немає контракту'],['percent'=>'Процент'],['static'=>'Статичний'],['array'=>'Градація']), '',array('class' => 'form-control','id' => 'payment')) !!}
                    <span class="help-block">{{ $errors->first('payment_id', ':message') }}</span>
                </div>
                <span class="help-block">Виберіть тип контракту запропонований системою, для подальшого його налаштування.</span>
            </div>
        </div>
        <br/>
        <br/>
        <div class="form-group col-md-8 col-md-offset-2 type-payments" id="type-payments-percent" style="display: none">
            {!! Form::label('percent', 'Введіть % ставки для тренера на кожне заняття', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('percent',null, array('class' => 'form-control')) !!}
            </div>
            <span class="help-block">З кожного абонемента з одного заняття візьметься %. Наприклад (введено 50% і абонемент коштує 100 на 10 занять, тоді тренер за нього получить зп 5, але не менше ніж вказано в мінімальній ставці).</span>
        </div>

        <div class="form-group col-md-8 col-md-offset-2 type-payments" id="type-payments-static" style="display: none">
            {!! Form::label('static', 'Введіть статичну сумму ставки для тренера на кожне заняття', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('static',null, array('class' => 'form-control')) !!}
            </div>
            <span class="help-block">Тренер получить за дане заняття сталу суму яка ніяк не впливає на кількість абонементів,але не менше ніж вказано в мінімальній ставці.</span>
        </div>

        <div class="form-group col-md-8 col-md-offset-2 type-payments" id="type-payments-array" style="display: none">
            {!! Form::label('array', 'Дана ставка рахується за допомогою можливих кількох градацій', array('class' => 'control-label')) !!}
            <div class="payments">
                <div class="row">
                    <div class="controls col-md-2 col-xs-5">
                        <label>Мінімальна кількість клієнтів для отримання додаткової оплати</label>
                    </div>
                    <div class="controls col-md-2 col-xs-5">
                        <label>Сума додаткової оплати(за 1 клієнта)</label>
                    </div>
                </div>
                <div class="row payment" data-item="item0">
                    <div class="controls col-md-2 col-xs-5">
                        {!! Form::text('array[0][peopleCount]',null, array('class' => 'form-control')) !!}
                    </div>
                    <div class="controls col-md-2 col-xs-5">
                        {!! Form::text('array[0][value]',null, array('class' => 'form-control')) !!}
                    </div>

                    <button type="button" class="btn btn-danger remove-payment" id="item0">-</button>
                </div>

            </div>
            <button type="button" class="btn btn-info add-payment">+</button>
            <span class="help-block">Наприклад (до 5 абонементів сумма за кожен 5, від 6 до 10 сумма за кожен 10)</span>
        </div>

        <div class="form-group col-md-12">
            {!! Form::label('enabled', 'Активний?', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('enabled', 'Активний', array('class' => 'control-label')) !!}
                {!! Form::radio('enabled', '1', @isset($user)? $user->enabled : 'false') !!}
                {!! Form::label('enabled', 'Деактивний', array('class' => 'control-label')) !!}
                {!! Form::radio('enabled', '0', @isset($user)? $user->enabled : 'true') !!}
                <span class="help-block">Вказує на активність тренера. Ящо тренер буде "Дективний" інформація про нього та його тренування буде не доступна</span>
            </div>
        </div>
        <div class="form-group col-md-12">
            <button type="reset" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-remove-circle"></span> Очистити
            </button>
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if	(isset($user))
                    Зберегти
                @else
                    Створити
                @endif
            </button>
        </div>

    </div>
    {!! Form::close() !!}
    @stop
</div>

{{-- Scripts --}}
@section('custom-scripts')
    <script>
        $("#item0").hide();
        var i = 0;
        $(function() {
            $('#payment').on('change',function(){
                $('.type-payments').hide(500);
                console.log($(this).val());
                $('#type-payments-'+$(this).val()).show(500);
            })
        });
        $("button.add-payment").click(function() {
            i++;
            var itemList = $("div.row.payment")
                    .last()
                    .clone()
                    .appendTo($("div.payments"))
                    .attr('data-item','item'+i);

            itemList.find("input").attr("name",function(j,oldVal) {
                         return oldVal.replace(/\[(\d+)\]/,function(){
                            return "[" + i + "]";
                        });
                     })
            itemList.find("button").attr("id", 'item'+i).show();


            $(".remove-payment").click(function() {

                var id = $(this).attr('id');
                if (id == 'item0'){
                    return false;
                }
                $('[data-item=\''+id+'\']').remove();
            })

        });
    </script>

@stop