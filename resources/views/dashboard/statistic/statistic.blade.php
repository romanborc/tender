@extends('dashboard.layouts.app') @section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h2 class="h2">Панель Управления Администратора</h2>
</div>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 ">
        <h2>Статистика</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Статистика</li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInDown">
    <div class="row">
            <div class="col-lg-3">
                <div class="widget style1">
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <i class="fa fa-trophy fa-5x"></i>
                            </div>
                            <div class="col-sm-8 text-right">
                                <span> Сегодня выиграли на сумму </span>
                                <h2>&#8372; 4,232</h2>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-sm-8 text-right">
                            <span> Сегодня торгов </span>
                            <h2>26</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fa fa-check fa-5x"></i>
                        </div>
                        <div class="col-sm-8 text-right">
                            <span> Сегодня выиграли торгов  </span>
                            <h2 class="font-bold">20</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 red-bg">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fa fa-times fa-5x"></i>
                        </div>
                        <div class="col-sm-8 text-right">
                            <span> Сегодня проиграли торгов </span>
                            <h2 class="font-bold">6</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
            <div class="col-lg-6">
                <div class="widget navy-bg no-padding">
                    <div class="p-m">
                        <h1 class="m-xs">&#8372; 1 600,540</h1>

                        <h3 class="font-bold no-margins">
                            Сумма выигрыша за год
                        </h3>
                        <h5>ТОВ "Лизоформ Медикал"</h5>
                        <button type="button" class="btn btn-outline btn-default">Подробней</button>
                    </div>
                    <div class="flot-chart">
                        <div class="flot-chart-content" id="flot-chart1" style="padding: 0px; position: relative;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="widget lazur-bg no-padding">
                    <div class="p-m">
                        <h1 class="m-xs">&#8372; 4 210,660</h1>

                        <h3 class="font-bold no-margins">
                            Сумма выигрыша за год
                        </h3>
                        <h5>ТОВ "Имед"</h5>
                        <button type="button" class="btn btn-outline btn-default">Подробней</button>
                    </div>
                    <div class="flot-chart">
                        <div class="flot-chart-content" id="flot-chart2" style="padding: 0px; position: relative;"></div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
                <div class="col-lg-4">
                    <div class="widget style1 lazur-bg">
                        <div class="row vertical-align">
                            <div class="col-sm-2">
                                <i class="fa fa-user fa-3x"></i>
                            </div>
                            <div class="col-sm-10 text-right">
                                <h2 class="font-bold">16</h2>
                                <h4>Количество менеджеров</h4>
                                <button type="button" class="btn btn-outline btn-default">Подробней</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget style1 navy-bg">
                        <div class="row vertical-align">
                            <div class="col-sm-3">
                                <i class="fa fa-percent fa-3x"></i>
                            </div>
                            <div class="col-sm-9 text-right">
                                <h2 class="font-bold">65</h2>
                                <h4>Побед за все время</h4>
                                <button type="button" class="btn btn-outline btn-default">Подробней</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget style1 red-bg">
                        <div class="row vertical-align">
                            <div class="col-sm-3">
                                <i class="fa fa-percent fa-3x"></i>
                            </div>
                            <div class="col-sm-9 text-right">
                                <h2 class="font-bold">10</h2>
                                <h4>Не участия за все время</h4>
                                <button type="button" class="btn btn-outline btn-default">Подробней</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
</div>
@endsection