@extends('layouts.app')
@section('title')
    | Register
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Doctor Registration</div>
                <div class="panel-body">
                     @include('partials.flash', ['some' => 'data'])
                    <form data-parsley-validate class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                                                  
                                   <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required="" autofocus style="text-transform: uppercase;" data-parsley-required-message="*Name is required" placeholder="Full Name (Do Not Suffix Dr.)"> 
                               
                                

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required="" data-parsley-required-message="*A valid Email is required to register" placeholder="Email Address">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('passkey') ? ' has-error' : '' }}">
                            <label for="passkey" class="col-md-4 control-label">Passkey</label>

                            <div class="col-md-6">
                                <input id="passkey" type="text" class="form-control" name="passkey" value="{{ old('passkey') }}" required data-parsley-required-message="*The Passkey value is required to be filled in!" placeholder="Passkey">

                                @if ($errors->has('passkey'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passkey') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required="" minlength="6" data-parsley-required-message="*Please set your password" placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="" data-parsley-equalto="#password" data-parsley-required-message="*Please confirm your password!" data-parsley-equalto-message="*This should match the password provided!" placeholder="Password Again">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                              
                                Have an account? <a href="{{ url('/login') }}"><strong>LOGIN</strong></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
