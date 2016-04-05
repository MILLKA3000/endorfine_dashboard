<section class="content-dashboard-footer">
    <div class="box box-primary content-box">

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-widget widget-user-2 widget-user-header dashboard_footer">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-image">
                    <img class="img-circle" src="/img/birthday-cake1.jpg" alt="Birthday">
                </div>
                <!-- /.widget-user-image -->
                <div class="tools-block">
                    @for ($i=0;$i<count($birthdays);$i=$i+3)
                        <div>
                            <a href="clients/{{$birthdays[$i]->id}}"><h5 class="widget-user-desc">{{$birthdays[$i]->birthday}} - {{$birthdays[$i]->name}}</h5></a>
                            @if($i+1<count($birthdays))
                                <a href="clients/{{$birthdays[$i+1]->id}}"><h5 class="widget-user-desc">{{$birthdays[$i+1]->birthday}} - {{$birthdays[$i+1]->name}}</h5></a>
                            @endif
                            @if($i+2<count($birthdays))
                                <a href="clients/{{$birthdays[$i+2]->id}}"><h5 class="widget-user-desc">{{$birthdays[$i+2]->birthday}} - {{$birthdays[$i+2]->name}}</h5></a>
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-widget widget-user-2 widget-user-header dashboard_footer">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-image">
                    <img class="img-circle" src="/img/ticket-icon_1.png" alt="Ticket">
                </div>
                <!-- /.widget-user-image -->
                <div class="tools-block-end-ticket">
                    @for ($i=0;$i<count($endOfDateTickets);$i=$i+3)
                        <div>
                            <a href="clients/{{$endOfDateTickets[$i]->getNameClient->id}}"><h5 class="widget-user-desc">№ {{$endOfDateTickets[$i]->numTicket}} [ {{$endOfDateTickets[$i]->dateFromReserve}} ] - {{$endOfDateTickets[$i]->getNameClient->name}}</h5></a>
                            @if($i+1<count($endOfDateTickets))
                                <a href="clients/{{$endOfDateTickets[$i+1]->getNameClient->id}}"><h5 class="widget-user-desc">№ {{$endOfDateTickets[$i+1]->numTicket}} [ {{$endOfDateTickets[$i+1]->dateFromReserve}} ] - {{$endOfDateTickets[$i+1]->getNameClient->name}}</h5></a>
                            @endif
                            @if($i+2<count($endOfDateTickets))
                                <a href="clients/{{$endOfDateTickets[$i+2]->getNameClient->id}}"><h5 class="widget-user-desc">№ {{$endOfDateTickets[$i+2]->numTicket}} [ {{$endOfDateTickets[$i+2]->dateFromReserve}} ] - {{$endOfDateTickets[$i+2]->getNameClient->name}}</h5></a>
                            @endif
                        </div>
                    @endfor
                </div>

            </div>
        </div>
    </div>
</section>