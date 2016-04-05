@include('layouts.header')
@yield('custom-style')
<body class="{{Cache::get('themes')}}">
<div class="wrapper">

    @if (!Auth::guest())

        @include('layouts.nav-bar')
        <!-- Left side column. contains the logo and sidebar -->

        @include('layouts.menu')

        <div class="content-wrapper">
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
  @yield('custom-scripts-sub')
</body>
<script>

</script>
</html>