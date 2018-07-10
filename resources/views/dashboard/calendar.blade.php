@extends('dashboard.layouts.app') @section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h2 class="h2">Панель Управления Администратора</h2>
</div>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 ">
        <h2>Календарь</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Календарь</li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">
        <div class="col-lg-12">
            <div id="calendar"></div>
        </div>
    </div>
</div>


@endsection
