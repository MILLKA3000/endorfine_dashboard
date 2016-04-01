<div class="box-body no-padding">
    <div class="col-md-12 col-sm-12">
        <div class="time-line img-bordered-sm">
            <div id="pbar_outerdiv">
                <div id="pbar_innerdiv"></div>
                <div id="pbar_innertext"></div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="tickets-accordion">
                <ul>
                    @foreach($trainings as $training)

                        <li id="{{$training['id']}}" class="event-acordion">
                            <div class="small-box">
                                <div class="inner">
                                    <div class="">
                                        <h4 class="widget-user-desc text-bold text-center">{{date("H:i", strtotime($training['start']))}}</h4>
                                        <h4 class="widget-user-desc text-bold text-center">{{$training['title']}}</h4>
                                        <h4 class="widget-user-desc">Тренер: {{$training['trainer']}}</h4>
                                        <h4 class="widget-user-desc">Клієнтів: {{count($training['clients'])}}</h4>
                                    </div>
                                </div>
                                <a href="#" class="icon">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                                <div class="clients hidden">
                                    @if(count($training['clients'])>0)
                                        <p>
                                            @foreach($training['clients'] as $client)
                                                <span class="label">{{$client->getTicket->getNameClient->name}}</span>
                                            @endforeach
                                        </p>

                                    @endif
                                </div>

                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>