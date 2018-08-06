<div class="modal fade bd-edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Редактировать Закупку</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-10">
                        <form class="form-horizontal update">
                            {{ csrf_field() }}
                            <div class="form-group row proc">
                                <label class="col-sm-3 control-label">Заказчик</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="customer" id="customer" placeholder="" required>
                                    <span class="help-block">
                                        <strong><p class="customer"></p></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row proc">
                                <label class="col-sm-3 control-label">ID Закупки</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="id_procurement" id="id_procurement" data-mask="aa-9999-99-99-999999-a" placeholder="" value="{{ old('id_procurement') }}">
                                    <span class="help-block">
                                        <strong><p class="id_procurement"></p></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row proc">
                                <label class="col-sm-3 control-label">Подать до</label>
                                <div class="col-sm-8">
                                    <input type="datetime" class="form-control" name="offers_period_end" id="offers_period_end" data-mask="99-99-9999 99:99" placeholder="" value="{{ old('offers_period_end') }}">
                                    <span class="help-block">
                                        <strong><p class="offers_period_end"></p></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row proc">
                                <label class="col-sm-3 control-label">Время аукциона</label>
                                <div class="col-sm-8">
                                    <input type="datetime" class="form-control" name="auction_period_end" id="auction_period_end" data-mask="99-99-9999 99:99" placeholder="" value="{{ old('auction_period_end') }}">
                                    <span class="help-block">
                                        <strong><p class="auction_period_end"></p></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row proc">
                                <label class="col-sm-3 control-label">Ожидаемая стоимость</label>
                                <div class="col-sm-8">
                                    <input type="number" step="any" class="form-control" name="amount" id="amount" placeholder="" value="{{ old('amount') }}">
                                    <span class="help-block">
                                        <strong><p class="amounts"></p></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row proc">
                                <label class="col-sm-3 control-label">Ответственный Менеджер</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="users_id" id="users">
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{$user->firstname}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">
                                        <strong><p class="users_id"></p></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row proc">
                                <label class="col-sm-3 control-label">Предмет Закупки</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="subjects_id" id="subjects">
                                        @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">
                                            {{$subject->subject}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">
                                        <strong><p class="subjects_id"></p></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row proc">
                                <label class="col-sm-3 control-label">Тип Закупки</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="types_id" id="types">
                                        @foreach($types as $type)
                                        <option value="{{ $type->id }}">
                                            {{$type->type}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">
                                        <strong><p class="types_id"></p></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row proc">
                                <label class="col-sm-3 control-label">ЕДРПО</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="identifier" id="identifier_id" placeholder="" value="{{ old('identifier') }}">
                                    <span class="help-block">
                                        <strong><p class="identifier"></p></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row proc">
                                <label class="col-sm-3 control-label">Статус</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="statuses_id" id="statuses">
                                        @foreach($statuses as $status)
                                        <option value="{{ $status->id }}">
                                            {{$status->status}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">
                                        <strong>
                                            <p class="statuses_id"></p>
                                        </strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row proc">
                                <label class="col-sm-3 control-label">Описание</label>
                                <div class="col-md-8">
                                    <textarea class="form-control textarea-edit" name="description" id="description" placeholder="" value="{{ old('description') }}"></textarea>
                                    <span class="help-block">
                                        <strong>
                                            <p class="description"></p>
                                        </strong>
                                    </span>
                                </div>
                            </div>
                            <input type="hidden" id="procurement_id" name="id">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Свернуть</button>
                                <button type="button" class="btn btn-danger delitPrcourement">Удалить Закупку</button>
                                <button type="button" class="btn btn-primary editPrcourement">Изменить Закупку</button>
                            </div>

                            <div class="show_lot_modal">
                                <div class="content_lot">
                                    <div class="lot-header">
                                        <h2>Редактировать Лоты:</h2>
                                        <button type="button" class="close close-lot-modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="ibox-content tree_lot">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-2">
                        <a href="#" class="btn btn btn-success add_lot">Лоты <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>