@extends('dashboard.layouts.app') @section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h2 class="h2">Панель Управления Администратора</h2>
</div>
<div class="row wrapper white-bg page-heading">
    <div class="col-lg-7 ">
        <h2>Статистика</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Статистика</li>
        </ol>
    </div>
    <div class="col-lg-5">
         <form class="form-horizontal" method="get" action="/admin/filter">
        <div class="row">
            
            <div class="col-sm-4">
                <h3>Фильтер по дате</h3>
            </div>
            <div class="col-sm-3">
                <input type="date" id="offers_period_from" name="offers_period_from" class="form-control input-datepicker" placeholder="c">
            </div>
            <div class="col-sm-3">
                <input type="date" id="offers_period_to" name="offers_period_to" class="form-control input-datepicker" placeholder="по">
            </div>
            <div class="col-sm-2">
                <button class="btn btn-primary" type="submit">Фильтр</button>
            </div>
       
        </div>
         </form>
    </div>
</div>
<div class="table-responsive animated fadeInRight">
    <table class="table table-bordered table-hover">
        <tbody>
            @foreach($userStatistics as $userStatistic)
            <tr>
                <td class="results-completion">
                    <small>Менеджер</small>
                    <div>{{ $userStatistic->lastname }}</div>
                </td>
                <td class="results-completion">
                    <small>Процент не участия: {{ round(($userStatistic->non_participation/$userStatistic->proc_count)*100) }}% </small>
                    <div class="progress progress-mini">
                        <div style="width: {{ ($userStatistic->non_participation/$userStatistic->proc_count)*100 }}%;" class="progress-bar bg-warning"></div>
                    </div>
                </td>
                <td class="results-completion">
                    <small>Процент проигрыша: {{ round(($userStatistic->proc_losing/$userStatistic->proc_count)*100) }}%</small>
                    <div class="progress progress-mini">
                        <div style="width: {{ ($userStatistic->proc_losing / $userStatistic->proc_count)*100 }}%;" class="progress-bar bg-danger"></div>
                    </div>
                </td>
                <td class="results-completion">
                    <small>Процент выиграша: {{ round(($userStatistic->proc_wining/$userStatistic->proc_count)*100) }}%</small>
                    <div class="progress progress-mini">
                        <div style="width: {{ ($userStatistic->proc_wining / $userStatistic->proc_count)*100 }}%;" class="progress-bar bg-success"></div>
                    </div>
                </td>
                <td class="results-completion">
                    <small>Участия: </small>
                    <div>{{ $userStatistic->proc_count }}</div>
                </td>
                <td class="results-completion">
                    <small>Сумма выиграша: </small>
                    <div>{{ number_format($userStatistic->sum_total, 2,',', ' ') }}</div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection