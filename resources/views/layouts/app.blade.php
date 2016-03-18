@include('layouts.header')
@yield('custom-style')
<body class="skin-blue">
<div class="wrapper">

    @if (!Auth::guest())

        @include('layouts.nav-bar')
        <!-- Left side column. contains the logo and sidebar -->

        @include('layouts.menu')

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Page Header
                    <small>Optional description</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                    <li class="active">Here</li>
                </ol>
            </section>

    @endif
    <section class="content">
        @yield('content')
    </section>

    @if (!Auth::guest())
        <!-- Main Footer -->
        @include('layouts.footer')
    @endif

</div>
  @include('layouts.global-scripts')
  @yield('custom-scripts')
</body>
</html>