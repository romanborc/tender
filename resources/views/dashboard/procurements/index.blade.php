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
        <a href="#" class="btn btn-info btn-rounded" data-toggle="modal" data-target=".bd-example-modal-lg">Фильтры</a>
        <a href="admin/procurements/create" class="btn btn-primary btn-rounded">+ Добавить Закупку</a>
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
                        <a href="https://zakupki.prom.ua/gov/tenders/{{ $procurement->id_procurement }}" target="_blank">
                            <p class="id_procurement">{{ $procurement->id_procurement }}</p>
                        </a>
                    </div>
                    <p class="customer">{{ $procurement->customer }}</p>
                    <p class="badge badge-info">{{ $procurement->types->type }} </p>
                    <p class="badge badge-info">
                        @if($procurement->users) {{ $procurement->users->firstname }} @else Не назначена
                    </p>
                    @endif
                    <h3 id="status" class="{{ $procurement->statuses_id == 1 ? 'badge badge-primary' : 'badge badge-danger' }}">{{ $procurement->statuses->status }}
                    </h3>
                </td>
                <td class="col-sm-2">
                    <p class="amount">{{ number_format($procurement->amount, 2,',', ' ') }}</p>
                </td>
                <td class="col-sm-2">
                    <h3>Добавлена: </h3>
                    <p>{{ $procurement->created_at }}</p>
                    <h3>Прием предложений до:</h3>
                    <p>{{ $procurement->offers_period_end }}</p>
                    <h3>Аукцион:</h3>
                    <p>{{ $procurement->auction_period_end }}</p>
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
                    <h3>Результат :</h3>
                    <p class="result">{{ $result->results }}</p>
                    <h3>Участник :</h3>
                    <p class="participant">{{ $result->participants->name }}</p>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $procurements->appends(['search' => $search])->links() }}
</div>
<!-- Modal for Results -->
<div class="modal fade bd-results-modal-lg" id="resultsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавить результаты Аукциона</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="ibox-content">
                        <div class="form-group row {{ $errors->has('results') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-sm-3 control-label">Результаты Аукциона</label>
                            <div class="col-md-9 add">
                                <textarea class="form-control" name="results" id="results" placeholder="">
                                </textarea style="width:300px;">
                                @if ($errors->has('results'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('results') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('participants_id') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-sm-3 control-label">Участник</label>
                            <div class="col-md-9">
                                <select class="form-control" name="participants_id" id="participants_id">
                                    @foreach($participants as $participant)
                                    <option value="{{ $participant->id }}">
                                        {{$participant->name}}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('participants'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('participants') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <input type="hidden" id="result_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Свернуть</button>
                        <button type="button" class="btn btn-primary saveresults">Записать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Search -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Фильтры</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/admin/search">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-4">
                            Конец приема предложений
                        </div>
                        <div class="col-sm-4">
                            <input type="date" id="offers_period_from" name="offers_period_from" class="form-control input-datepicker" placeholder="c">
                        </div>
                        <div class="col-sm-4">
                            <input type="date" id="offers_period_to" name="offers_period_to" class="form-control input-datepicker" placeholder="по">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            Дата аукциона
                        </div>
                        <div class="col-sm-4">
                            <input type="date" id="auction_period_from" name="auction_period_from" class="form-control input-datepicker" placeholder="c">
                        </div>
                        <div class="col-sm-4">
                            <input type="date" id="auction_period_to" name="auction_period_to" class="form-control input-datepicker" placeholder="по">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            Ожидаемая стоимость
                        </div>
                        <div class="col-sm-4">
                            <input type="number" id="amout_from" name="amout_from" class="form-control" placeholder="от">
                        </div>
                        <div class="col-sm-4">
                            <input type="number" id="amout_to" name="amout_to" class="form-control" placeholder="до">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            Код ЕДРПО Заказчика
                        </div>
                        <div class="col-sm-8">
                            <input type="number" id="identifier" name="identifier" class="form-control" placeholder="Код ЕДРПО">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            Ответственный менеджер
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="users_id" id="users_id">
                                <option value="" selected>Выбери Менеджера</option>
                                <option value="null">Не определен</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->lastname }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            Поиск по статусу
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="statuses_id" id="statuses_id">
                                <option value="" selected>Выбери статус</option>
                                @foreach($statuses as $status)
                                <option value="{{ $status->id }}">
                                    {{ $status->status }}
                                </option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            Поиск по типу
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="types_id" id="types_id">
                                <option value="" selected>Выбери тип</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->type }}
                                </option>

                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer ">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Свернуть</a>
                <button class="btn btn-primary" type="submit">Поиск</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal for Edit Procurement -->
 @include('dashboard.procurements.edit')



@endsection