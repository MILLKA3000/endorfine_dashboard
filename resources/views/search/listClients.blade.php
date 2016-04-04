<a href="#" class="click-to-detail" data-id="{{$clients->getNumTicket->numTicket}}">
    <div class="col-md-12 col-sm-12 col-xs-12 responsive">
        <div class="info-box search-list-item">
            {{--<div class="box-body box-profile"> <img class="img-responsive" style="width: 100%" src="{{$numAbonement->getNameClient->photo}}" alt="Фото клієнта"></div>--}}

            <div class="info-box-content search-list-item">
                <div class="col-md-1">
                    <img class="img-responsive" src="{{$clients->photo}}" alt="Фото клієнта">
                    @if( $clients->birthday == date('m-d') )
                        <img class="img-responsive" style="position: absolute; top: -20px; left: -20px; width: 40%" src="/img/birthday-surp.png">
                    @endif
                </div>
                <div class="col-md-4 search-list-item">
                    <span class="info-box-text">Ім'я</span>
                    <span class="info-box-text">{{$clients->name}}</span>
                </div>
                <div class="col-md-3 search-list-item">
                    <span class="info-box-text">День нардження</span>
                    <span class="info-box-text">{{$clients->birthday}}</span>
                </div>
                <div class="col-md-4">
                    <span class="info-box-text">Телефон</span>
                    <span class="info-box-text">{{$clients->phone}}</span>
                </div>
                <div class="col-md-3">
                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                            70% Increase in 30 Days
                    </span>
                </div>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

</a>