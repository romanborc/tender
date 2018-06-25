<div class="modal fade bd-filter-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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