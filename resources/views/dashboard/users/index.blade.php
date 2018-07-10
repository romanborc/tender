@extends('dashboard.layouts.app') @section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2">Панель Управления Администратора</h1>
</div>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 ">
        <h2>Все Менеджеры</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Пользователи</li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInDown">
    <div class="row">
        @foreach($users as $user)
        <div class="col-lg-4">
            <div class="contact-box">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <div class="m-t-xs font-bold">
                                @if($user->admin)
                                    Администратор
                                @else
                                    Менеджер
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong>{{ $user->firstname }} {{ $user->lastname }}</strong></h3>
                            <strong>E-Mail</strong>
                            {{ $user->email }}
                            <br>
                            <strong>Телефон</strong>
                            {{ $user->tel }}
                            <br>
                    </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection