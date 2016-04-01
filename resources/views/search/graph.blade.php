@include('search.accordion')

@section('custom-scripts-sub')
    <script src="{{ asset ("/js/dashboard/accordion-dashboard.js") }}" type="text/javascript"></script>
    <script>
        initDashboardAcordion({!!json_encode($trainings)!!});
    </script>
@endsection

