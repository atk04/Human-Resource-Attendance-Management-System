@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                <div class="card card-login" style="height:20em;">
                    <form class="form" method="POST" action="{{ route('admin.postLogin') }}">
                        @csrf
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title"> Admin Login</h4>

                        </div>

                        <div class="card-body">

                            <div class="input-group">
                                <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-envelope-o"></i>
                    </span>
                                </div>
                                <input id="email" type="email" placeholder="E-Mail Address"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                       value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock"></i>
                    </span>
                                </div>
                                <input id="password" type="password" placeholder="Password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>

                            <div class="input-group-text">
                                <div class="col-md-12 text-center">
                                    <button type="submit"  class="btn btn-primary btn-wd btn-lg">Login</button>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>










@endsection
