@extends('auth.layouts.app')

@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">Tender</h1>
            </div>
            <h3>Welcome to Tender</h3>
            <p>Платформа распределения тендеров для Prozorro</p>
            
            <form class="m-t" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="E-mail адресс">
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control" name="password" required placeholder="Твой пароль">
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} > Запомнить Меня
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Войти</button>

                <a href="{{ route('password.request') }}"><small>Забыл Пароль?</small></a>
                <p class="text-muted text-center"><small>Нет аккаунта?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Создай Аккаунт</a>
            </form>
            <p class="m-t"> <small>Tender &copy; 2018</small> </p>
        </div>
    </div>
@endsection
