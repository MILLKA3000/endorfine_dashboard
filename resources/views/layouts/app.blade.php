@include('layouts.header')
@yield('custom-style')
<body class="skin-red">
<div class="wrapper">

    @if (!Auth::guest())

        @include('layouts.nav-bar')
        <!-- Left side column. contains the logo and sidebar -->

        @include('layouts.menu')

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            {{--<section class="content-header">--}}
                {{--<h1>--}}
                    {{--Page Header--}}
                    {{--<small>Optional description</small>--}}
                {{--</h1>--}}
                {{--<ol class="breadcrumb">--}}
                    {{--<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>--}}
                    {{--<li class="active">Here</li>--}}
                {{--</ol>--}}
            {{--</section>--}}
            <section class="content">
                <div class="box box-primary content-box">
                    @yield('content')
                </div>
            </section>
                    @yield('footer-info')
    @else
            <section class="content">
                @yield('content')
            </section>

    @endif
</div>
    @if (!Auth::guest())
        <!-- Main Footer -->
        @include('layouts.footer')
    @endif


  @include('layouts.global-scripts')
  @yield('custom-scripts')
</body>
<script>

</script>
</html>