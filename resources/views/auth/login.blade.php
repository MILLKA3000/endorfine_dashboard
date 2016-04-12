@extends('layouts.app')

@section('custom-style')
    <style>
        html{
            background:linear-gradient(to bottom, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.4)),url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHZlcnNpb249JzEuMScgd2lkdGg9JzQwMCcgaGVpZ2h0PSc0MDAnPgoJPGRlZnMgaWQ9J2RlZnM0Jz4KCQk8ZmlsdGVyIGNvbG9yLWludGVycG9sYXRpb24tZmlsdGVycz0nc1JHQicgaWQ9J2ZpbHRlcjMxMTUnPgoJCQk8ZmVUdXJidWxlbmNlIHR5cGU9J2ZyYWN0YWxOb2lzZScgbnVtT2N0YXZlcz0nMScgYmFzZUZyZXF1ZW5jeT0nMC45JyBpZD0nZmVUdXJidWxlbmNlMzExNycgLz4KCQkJPGZlQ29sb3JNYXRyaXggcmVzdWx0PSdyZXN1bHQ1JyB2YWx1ZXM9JzEgMCAwIDAgMCAwIDEgMCAwIDAgMCAwIDEgMCAwIDAgMCAwIDYgLTMuNzUgJyBpZD0nZmVDb2xvck1hdHJpeDMxMTknIC8+CgkJCTxmZUNvbXBvc2l0ZSBpbjI9J3Jlc3VsdDUnIG9wZXJhdG9yPSdpbicgaW49J1NvdXJjZUdyYXBoaWMnIHJlc3VsdD0ncmVzdWx0NicgaWQ9J2ZlQ29tcG9zaXRlMzEyMScgLz4KCQkJPGZlTW9ycGhvbG9neSBpbj0ncmVzdWx0Nicgb3BlcmF0b3I9J2RpbGF0ZScgcmFkaXVzPScxMCcgcmVzdWx0PSdyZXN1bHQzJyBpZD0nZmVNb3JwaG9sb2d5MzEyMycgLz4KCQk8L2ZpbHRlcj4KCTwvZGVmcz4KCTxyZWN0IHdpZHRoPScxMDAlJyBoZWlnaHQ9JzEwMCUnIHg9JzAnIHk9JzAnIGlkPSdyZWN0Mjk4NScgZmlsbD0nI2VlZWVlZScvPiAgICAgCgk8cmVjdCB3aWR0aD0nMTAwJScgaGVpZ2h0PScxMDAlJyB4PScwJyB5PScwJyBpZD0ncmVjdDI5ODUnIHN0eWxlPSdmaWxsOiNlMDg3Mjg7ZmlsdGVyOnVybCgjZmlsdGVyMzExNSknIC8+Cjwvc3ZnPg==)!important;

        }
        body, .wrapper,.login-page{
            background: none!important;
            background-color: none!important;
        }
    </style>
@endsection

@section('content')
<div class="hold-transition login-page">
    <div class="login-box">
        {{--<div class="login-logo">--}}
            {{--<a href="../../index2.html"><b>Admin</b>LTE</a>--}}
        {{--</div>--}}
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{!! Cache::get('logo_switcher') == 'on' ? '<div class="logoinclude"></div>' : Cache::get('title')!!}</p>

            <form action="{{ url('/login') }}" method="post">

                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        {{--<div class="checkbox icheck">--}}
                            {{--<label>--}}
                                {{--<div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div> Remember Me--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            {{--<div class="social-auth-links text-center">--}}
                {{--<p>- OR -</p>--}}
                {{--<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using--}}
                    {{--Facebook</a>--}}
                {{--<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using--}}
                    {{--Google+</a>--}}
            {{--</div>--}}
            <!-- /.social-auth-links -->

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

</div>

@endsection

@section('custom-scripts')
    <script src="{{ asset("bower_components/AdminLTE//plugins/iCheck/icheck.min.js") }}"></script>
    <script>

        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection