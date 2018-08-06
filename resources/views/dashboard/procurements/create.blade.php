@extends('dashboard.layouts.app') @section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Добавить новую Закупку</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-9">
        <div class="ibox-content">
            <form class="form-horizontal create">
                {{ csrf_field() }}
                <div class="form-group row proc">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Заказчик</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="customer" id="customer" placeholder=""> 
                        <span class="help-block">
                            <strong><p class="customer"></p></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row proc">
                    <label class="col-sm-2 col-sm-2 control-label">ID Закупки</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="id_procurement" data-mask="aa-9999-99-99-999999-a" placeholder="" value=""> 
                        <span class="help-block">
                            <strong><p class="id_procurement"></p></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row proc">
                    <label class="col-sm-2 col-sm-2 control-label">Подать до</label>
                    <div class="col-sm-8">
                        <input type="datetime" class="form-control" name="offers_period_end" data-mask="99-99-9999 99:99" placeholder="" value=""> 
                        <span class="help-block">
                            <strong><p class="offers_period_end"></p></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row proc">
                    <label class="col-sm-2 col-sm-2 control-label">Время аукциона</label>
                    <div class="col-sm-8">
                        <input type="datetime" class="form-control" name="auction_period_end" data-mask="99-99-9999 99:99" placeholder="" value="">
                        <span class="help-block">
                            <strong><p class="auction_period_end"></p></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row proc">
                    <label class="col-sm-2 col-sm-2 control-label">Ожидаемая стоимость</label>
                    <div class="col-sm-8">
                        <input type="number" step="any" class="form-control" name="amount" placeholder="" value=""> 
                        <span class="help-block">
                            <strong><p class="amounts"></p></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row proc">
                    <label class="col-sm-2 col-sm-2 control-label">Ответственный Менеджер</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="users_id" id="users_id">
                            <option value="" selected>Не определен</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->lastname }}
                            </option>
                            @endforeach
                        </select>
                        <span class="help-block">
                            <strong><p class="users_id"></p></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row proc">
                    <label class="col-sm-2 col-sm-2 control-label">Предмет Закупки</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="subjects_id" id="subjects_id">
                            @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">
                                {{ $subject->subject }}
                            </option>
                            @endforeach
                        </select>
                        <span class="help-block">
                            <strong><p class="subjects_id"></p></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row proc">
                    <label class="col-sm-2 col-sm-2 control-label">Тип Закупки</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="types_id" id="types_id">
                            @foreach($types as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->type }}
                            </option>
                            @endforeach
                        </select>
                        <span class="help-block">
                            <strong><p class="types_id"></p></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row proc">
                    <label class="col-sm-2 col-sm-2 control-label">Код ЕДРПО</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="identifier" placeholder="" value="">
                        <span class="help-block">
                            <strong><p class="identifier"></p></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row proc">
                    <label class="col-sm-2 col-sm-2 control-label">Статус</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="statuses_id" id="statuses_id">
                            @foreach($statuses as $status)
                            <option value="{{ $status->id }}">
                                {{ $status->status }}
                            </option>
                            @endforeach
                        </select>
                        <span class="help-block">
                            <strong><p class="statuses_id"></p></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row proc">
                    <label class="col-sm-2 col-sm-2 control-label">Описание</label>
                    <div class="col-md-8">
                        <textarea class="form-control" name="description" id="description" placeholder="" value=""></textarea>
                        <span class="help-block">
                            <strong><p class="description"></p></strong>
                        </span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <a href="/admin" class="btn btn-white">Назад</a>
                        <a href="#" class="btn btn-primary createProcurements">+Добавить Закупку</a>
                    </div>
                </div>
                <div class="create_lot">
                    <div class="content">
                        <div class="ibox-title">
                            <h1>Создать лоты:</h1>
                        </div>
                        <div class="ibox-content tree">
                            <div class="row">
                                <div class="col-lg-11">
                                    <input type="hidden" name="details[0][id]">
                                    <div class="form-group row lot">
                                        <label class="col-sm-4 control-label">Название</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="details[0][name]" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row lot">
                                        <label class="col-sm-4 control-label">Подать до</label>
                                        <div class="col-sm-8">
                                            <input type="datetime" class="form-control" name="details[0][offers_period_end_lot]" data-mask="99-99-9999 99:99" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row lot">
                                        <label class="col-sm-4 control-label">Время аукциона</label>
                                        <div class="col-sm-8">
                                            <input type="datetime" class="form-control" name="details[0][auction_period_end_lot]" data-mask="99-99-9999 99:99" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row lot">
                                        <label class="col-sm-4 control-label">Сумма Лота</label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" name="details[0][amount_lot]" placeholder="" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <a href="#" class="add"><i class="fas fa-plus fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="hr"></div>
                        </div>
                        <div class="create_lot_footer">
                            <a href="#" class="btn-lot-secondary back">Закрыть</a>
                            <a href="#" class="btn-lot-primary save">Сохранить</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-3">
        <a href="#" class="btn btn btn-info add_lot">+Добавить Лот</a>
    </div>
</div>
@endsection