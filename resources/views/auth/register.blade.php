@extends('auth.layouts.app')

@section('content')
<div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">Tender</h1>
            </div>
            <h3>Зарегистрируйся в Tender</h3>
            <p>Создайте аккаунт, чтобы увидеть ее в действии.</p>
            <form class="m-t" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus placeholder="Имя">
                    @if ($errors->has('firstname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus placeholder="Фамилия">
                    @if ($errors->has('lastname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="E-mail адрес">
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control" name="password" required placeholder="Пароль">
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Подтверди Пароль">
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Зарегистрироваться</button>

                <p class="text-muted text-center"><small>Уже есть аккаунт</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Авторизоваться</a>
            </form>
            <p class="m-t"> <small>Tender&copy; 2018</small> </p>
        </div>
    </div>
@endsection
