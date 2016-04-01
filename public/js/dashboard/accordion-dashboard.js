function initDashboardAcordion(options) {
    var option = parseCalendar(options);
    var start_training;
    var end_training;
    var timer;
    var activeElement;
    timeTimer();

    function updateProgress(percentage) {
        $('#pbar_innerdiv').css("width", percentage + "%");
    }

    function updateClock() {
        var now = new Date();
        $('#pbar_innertext').text(now.getHours()+':'+(now.getMinutes()<10?'0':'') + now.getMinutes()+':'+(now.getSeconds()<10?'0':'') + now.getSeconds());
    }

    function animateUpdate() {
        clearTimeout(timer);
        $(activeElement).hover(function() {$(this).addClass("hover");});
        $(activeElement).mouseenter();
        var now = new Date().getTime();
        var perc = Math.round(((now - start_training)/(end_training - start_training))*100);
        if (perc <= 100) {
            updateProgress(perc);
            updateClock();
            setTimeout(animateUpdate, 1000);
        }else{
            $('.tickets-accordion li').removeClass("hover");
            timeTimer();
        }
    }

    function parseCalendar(prop){
        return prop;
    }

    function timeTimer(){
        var now = new Date().getTime();
        option.forEach(function(date){
            var start = new Date(date.start).getTime();
            var end = new Date(date.end).getTime();
            if (start < now) $('#'+date.id).addClass('event-acordion-last');
            if (start <= now && now <=end) {
                start_training = start;
                end_training = end;
                activeElement = '#'+date.id;
                animateUpdate()
            }
            updateClock();
        });

        timer = setTimeout(timeTimer, 1000);
    }

    console.log('wwwww');
}