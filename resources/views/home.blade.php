@extends('layouts.app')
@section('custom-style')
    <style>
        .tools-block div,
        .tools-block-end-ticket div{
            color: #333;
            display: none;
            font-weight: bold;
        }
        .tools-block div:first-child,
        .tools-block-end-ticket div:first-child{
            display: block;
        }
    </style>
@endsection
@section('content')

    <div>
        <input class="form-control input-lg" id="search" type="text" placeholder="Ім'я клієнта або номер абонимента">
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-warning">
                <div class="content-dashboard">
                    <div id="accordion-details-trainings">@include('search.graph')</div>
                    <div id="result-search" class="hidden"></div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

@section('footer-info')
    @if(Cache::get('footer') == 'on')
        @include('footer-info')
    @endif
@endsection

@section('custom-scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="{{ asset ("/js/dashboard/footer-transform-blocks.js") }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            timer = 0;
            $('#search').on('keyup', function () {
                var value = $(this).val();
                if (timer) {
                    clearTimeout(timer);
                }
                timer = setTimeout(function(){
                if ((value.length>=3)||((value[0]!='0')&&(value[0]!='+')&&($.isNumeric(value)))) {

                        if ((value.length>=5)&&(value[0] =='+')){
                            value = value.substr(3);
                        }
                            $.ajax({
                                method: "POST",
                                url: "/search",
                                dataType: 'html',
                                async: false,
                                type: 'post',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "search": value
                                },
                                success: function (data) {
                                    if(data) {
                                        $('#accordion-details-trainings').addClass('hidden');
                                        $('#result-search').removeClass('hidden').html(data);
                                        initSubFunctional();
                                    }else{
                                        getGraph();
                                    }
                                }
                            })
                    }else{
                        getGraph();
                    }
                }, 50);
            });

            function getGraph() {
                $('#accordion-details-trainings').removeClass('hidden');
                $('#result-search').addClass('hidden')
            }
            function initSubFunctional(){
                $('.click-to-detail').on('click',function(){
                    $('#search').val($(this).attr('data-id')).keyup();
                })
            }

        });

    </script>

@stop

