@extends('layouts.app')
{{-- Content --}}
@section('content')


        <div class="row">
            @include('client.clientInfo')
            <!-- /.col -->
            <div class="col-md-9">

                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="bottom-menu-header">
                                <h3>
                                    Добавити користувачу послугу
                                    <div class="pull-right">
                                        <div class="pull-right">
                                        </div>
                                    </div>
                                </h3>
                            </div>
                            {!! Form::open(array('url' => URL::to('/clients') . '/' . $client->id .'/saveServiceClient', 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
                                <div class="tab-content">
                                    <!-- General tab -->
                                    <div class="tab-pane active" id="tab-general">
                                        <div class="col-md-12">
                                            <div class="form-group col-xs-8 {{ $errors->has('service') ? 'has-error' : '' }}">
                                                {!! Form::label('service', 'Виберіть додаткову послугу', array('class' => 'control-label')) !!}
                                                <div class="controls">
                                                    {!! Form::select('service', $client->service->lists('name', 'id'), 1,array('class' => 'form-control')) !!}
                                                    <span class="help-block">{{ $errors->first('service', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="reset" class="btn btn-sm btn-default">
                                                    <span class="glyphicon glyphicon-remove-circle"></span> Очистити
                                                </button>
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <span class="glyphicon glyphicon-ok-circle"></span> Добавити
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.tab-pane -->
                    </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
@endsection
{{-- Scripts --}}
@section('custom-scripts')

@stop