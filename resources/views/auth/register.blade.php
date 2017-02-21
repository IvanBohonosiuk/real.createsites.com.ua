@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col m4">Name</label>

                                <div class="input-field col m6">
                                    <input id="name" type="text" class="validate" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col m4">E-Mail Address</label>

                                <div class="input-field col m6">
                                    <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col m4">Password</label>

                                <div class="input-field col m6">
                                    <input id="password" type="password" class="validate" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <label for="password-confirm" class="col m4">Confirm Password</label>

                                <div class="input-field col m6">
                                    <input id="password-confirm" type="password" class="validate" name="password_confirmation" required>
                                </div>
                            </div>

                            <div>
                                <label for="first_name" class="col m4">First Name</label>

                                <div class="input-field col m6">
                                    <input id="first_name" type="text" class="validate" name="first_name" required>
                                </div>
                            </div>

                            <div>
                                <label for="last_name" class="col m4">Last Name</label>

                                <div class="input-field col m6">
                                    <input id="last_name" type="text" class="validate" name="last_name" required>
                                </div>
                            </div>

                            <p>
                                <input name="roles" type="radio" id="test1" value="Freelancer" checked />
                                <label for="test1">Фрилансер</label>
                            </p>
                            <p>
                                <input name="roles" type="radio" id="test2" value="Customer" />
                                <label for="test2">Заказчик</label>
                            </p>

                            <div class="form-group">
                                <div class="col m6 offset-m4">
                                    <button type="submit" class="btn blue">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
