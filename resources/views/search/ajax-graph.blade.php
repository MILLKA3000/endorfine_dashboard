@include('search.accordion')

<script>
    initDashboardAcordion({!!json_encode($trainings)!!});
</script>