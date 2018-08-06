@extends('dashboard.layouts.app') @section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1>Панель Управления Администратора</h1>
</div>
<div class="row wrapper white-bg page-heading">
    <div class="col-md-9">
        <h2>Главная</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Главная</li>
        </ol>
    </div>
    <div class="col-md-3">
        <a href="#" class="btn btn-info btn-rounded" data-toggle="modal" data-target=".bd-filter-modal-lg">Фильтры</a>
        <a href="/admin/procurements/create" class="btn btn-primary btn-rounded">+ Добавить Закупку</a>
    </div>
</div>
<div class="table-responsive animated fadeInRight">
    <table class="table table-bordered table-hover">
        <thead>
            <tr class="d-flex" class="col-md-3">
                <th class="col-sm-3">Идентификатор закупки</th>
                <th class="col-sm-2">Ожидаемая стоимость</th>
                <th class="col-sm-2">Важные даты</th>
                <th class="col-sm-2">Статус</th>
                <th class="col-sm-1">Примечания</th>
                <th class="col-sm-2">Результаты</th>
            </tr>
        </thead>
        <tbody>
            @foreach($procurements as $procurement)
            <tr class="d-flex">
                <td class="col-sm-3">
                    <a href="#" class="edit" data-id="{{ $procurement->id }}" data-toggle="modal" data-target=".bd-edit-modal-lg">{{ $procurement->subjects->subject }}
                    </a>
                    <div class="type">
                        <a href="https://my.zakupki.prom.ua/cabinet/purchases/state_purchase/search/all?q={{ $procurement->id_procurement }}" target="_blank">
                            <p class="id_procurement">{{ $procurement->id_procurement }}</p>
                        </a>
                    </div>
                    <p class="customer">{{ $procurement->customer }}</p>
                    <p class="{{ ($procurement->types_id == 3 || $procurement->types_id == 4) ? 'badge badge-danger' : 'badge badge-info' }}">{{ $procurement->types->type }} </p>
                    <p class="badge badge-info">
                        @if($procurement->users) 
                            {{ $procurement->users->lastname }} 
                        @else 
                            Не назначена
                    </p>
                        @endif
                    <p id="statuses_id" class="{{ $procurement->statuses_id == 1 ? 'badge badge-primary' : 'badge badge-danger' }}">{{ $procurement->statuses->status }}
                    </p>
                </td>
                <td class="col-sm-2">
                    <p class="amount">{{ number_format($procurement->amount, 2,',', ' ') }}</p>
                </td>
                <td class="col-sm-2">
                    <h3>Добавлена: <p class="created_at">{{ Carbon\Carbon::parse($procurement->created_at)->format('d-m-Y H:i') }}</p></h3>
                    
                    <h3>Прием предложений до: <p class="offers_period">{{ Carbon\Carbon::parse($procurement->offers_period_end)->format('d-m-Y H:i') }}</p></h3>
                    
                    <h3>Аукцион: <p class="auction_period">{{ Carbon\Carbon::parse($procurement->auction_period_end)->format('d-m-Y H:i') }}</p></h3>
                    
                </td>
                <td class="col-sm-2">
                    <div>
                        @if($procurement->offers_period_end > Carbon\Carbon::now())
                        <p class="text">Осталось {{ $procurement->diff($procurement->offers_period_end )}}</p>
                        <p class="offers">Завершения приема предложений</p>
                        @elseif($procurement->auction_period_end > Carbon\Carbon::now())
                        <p class="text">Осталось {{ $procurement->diff($procurement->auction_period_end) }}</p>
                        <p class="auction">Аукционa</p>
                        @elseif($procurement->auction_period_end
                        < Carbon\Carbon::now()) <p class="qualification">Аукцион Закончился</p>
                            @endif
                    </div>
                </td>
                <td class="col-sm-1 description" data-id="{{ $procurement->id }}">
                    <p class="description">
                        {{ $procurement->description }}
                    </p>
                </td>
                <td class="col-sm-2 results" data-id="{{ $procurement->id }}">
                    @foreach($procurement->results as $result)
                    <h3>Результат : {{ $loop->iteration }}</h3>
                    <p class="result">{{ $result->results }}</p>                    
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $procurements->appends(Request::except('page'))->links() }}
</div>


<!-- Modal for Search -->
@include('dashboard.procurements.filter')
<!-- Modal for Edit Procurement -->
@include('dashboard.procurements.edit')
<!-- Modal for Results -->
@include('dashboard.procurements.results')

@endsection