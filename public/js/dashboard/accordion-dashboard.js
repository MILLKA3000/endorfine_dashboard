function initDashboardAcordion(options) {
    var option = parseCalendar(options);
    var start_training;
    var end_training;
    var timer;
    var timer2;
    var activeElement;
    timeTimer();

    function updateProgress(percentage,index) {
        $('#pbar_innerdiv_'+index).css("width", percentage + "%");
    }

    function updateClock(percentage,index) {
        perc = new Date(percentage);
        $('#pbar_innertext_'+index).text(perc.getUTCHours()+':'+(perc.getMinutes()<10?'0':'') + perc.getMinutes()+':'+(perc.getSeconds()<10?'0':'') + perc.getSeconds());

    }

    function animateUpdate(index) {
        clearTimeout(timer2);
        $(activeElement).hover(function() {$(this).addClass("hover").find('.small-box').removeClass("vertical");});
        $(activeElement).mouseenter();
        var now = new Date().getTime();
        var perc = Math.round(((now - start_training)/(end_training - start_training))*100);
        if (perc <= 100) {
            updateProgress(perc,index);
            updateClock(end_training - now ,index);
            timer2 = setTimeout(animateUpdate, 1000);
        }else{
            $('.tickets-accordion li').removeClass("hover").find('.small-box').addClass("vertical");
            timeTimer();
        }
    }

    function parseCalendar(prop){
        return prop;
    }

    function timeTimer(){
        var now = new Date().getTime();
        $.each(option, function(index, room) {
            room.forEach(function(date){
                var start = moment(date.start).valueOf();
                var end = moment(date.end).valueOf();
                if (start < now) {$('#'+date.id).addClass('event-acordion-last');}
                if (start <= now && now <=end) {
                    start_training = start;
                    end_training = end;
                    activeElement = '#'+date.id;
                    clearTimeout(timer);
                    animateUpdate(index)
                }

                updateClock();

            });

        });
        timer = setTimeout(timeTimer, 1000);

    }


}