<a href="#" class="click-to-detail" data-id="{{$clients->getNumTicket->numTicket}}">
    <div class="col-md-12 col-sm-12 col-xs-12 responsive">
        <div class="info-box search-list-item">
            <div class="info-box-content search-list-item">

                <div class="col-md-1 col-sm-1 col-xs-1">
                    <span class="info-box-text tickets-list-item">{{$clients->getNumTicket->numTicket}}</span>
                </div>

                <div class="col-md-1 col-sm-1 col-xs-1">
                    <img class="img-responsive" src="{{$clients->photo}}" alt="Фото клієнта">
                    @if( stristr($clients->birthday, date('m-d')) )
                        <img class="img-responsive" style="position: absolute; top: -20px; left: -20px; width: 40%" src="/img/birthday-surp.png">
                    @endif
                </div>

                <div class="col-md-4 col-sm-4 col-xs-4">
                    <span class="info-box-text">Ім'я: <span class="pull-right">{{$clients->name}}</span></span>
                    <span class="info-box-text">День нардження: <span class="pull-right">{{$clients->birthday}}</span></span>
                    <span class="info-box-text">Телефон: <span class="pull-right">{{$clients->phone}}</span></span>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-3">

                </div>

                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        @if ($clients->event->countAllTicketAccess() <= 500)
                            @for($i = 1; $i <= $clients->event->countAllTicketAccess(); $i++)
                                <div class="trening-box responsive"></div>
                            @endfor
                        @else
                            <span class="info-box-text infinity">∞</span>
                        @endif
                    </div>
                    <div class="line-vertical"></div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <span>{{$clients->event->countAllTicketAccess()}}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</a>