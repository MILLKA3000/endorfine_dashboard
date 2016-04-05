<div class="tab-content">
    <div class="active tab-pane" id="activity">
        <div class="bottom-menu-header">
            <h3>
                Добавити користувачу абонемент
                <div class="pull-right">
                    <div class="pull-right">
                    </div>
                </div>
            </h3>
        </div>
        @if (isset($activeTicket))
            {!! Form::model($activeTicket, array('url' => URL::to('/clients') . '/' .$activeTicket->id. '/updateTicketClient', 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
        @else
            {!! Form::open(array('url' => URL::to('/clients') . '/' . $client->id .'/saveTicketClient', 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
            @endif<!-- Tabs Content -->
        <div class="tab-content">
            <!-- General tab -->
            <div class="tab-pane active" id="tab-general">
                <div class="col-md-12">

                    <div class="form-group col-xs-8 {{ $errors->has('ticket_id') ? 'has-error' : '' }}">
                        {!! Form::label('ticket_id', 'Абонемент', array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::select('ticket_id', $client->tickets->lists('name', 'id'), (isset($activeTicket))?$activeTicket->ticket_id:'' ,array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('ticket_id', ':message') }}</span>
                        </div>
                    </div>

                    <div class="form-group col-xs-8 {{ $errors->has('discount_id') ? 'has-error' : '' }}">
                        {!! Form::label('discount_id', 'Знижка', array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::select('discount_id', $client->discounts->lists('name', 'id'), (isset($activeTicket))?$activeTicket->discount_id:'',array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('discount_id', ':message') }}</span>
                        </div>
                    </div>

                    @if (isset($activeTicket))

                        <div class="form-group col-xs-8 {{ $errors->has('discount') ? 'has-error' : '' }}">
                            {!! Form::label('statusTicket_id', 'Статус абонемента', array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::select('statusTicket_id', $client->statusTicket->lists('name', 'id'), (isset($activeTicket))?$activeTicket->statusTicket_id:'',array('class' => 'form-control')) !!}
                                <span class="help-block">{{ $errors->first('discount', ':message') }}</span>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="reset" class="btn btn-sm btn-default">
                            <span class="glyphicon glyphicon-remove-circle"></span> Очистити
                        </button>
                        <button type="submit" class="btn btn-sm btn-success">
                            @if (isset($activeTicket))
                                    <span class="glyphicon glyphicon-ok-circle"></span> Добавити
                            @else
                                    <span class="glyphicon glyphicon-ok-circle"></span> Зберегти
                            @endif
                        </button>

                    </div>
                </div>
            </div>


        </div>

        {!! Form::close() !!}
    </div>
    <!-- /.tab-pane -->
</div>
