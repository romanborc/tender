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
                <form class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group row {{ $errors->has('customer') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-form-label">Заказчик</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="customer" id="customer" placeholder=""  required>
                    <span class="help-block">
                        <strong><p id></p></strong>
                    </span>
                </div>
            </div>
            <div class="form-group row {{ $errors->has('id_procurement') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-sm-2 control-label">ID Закупки</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="id_procurement" id="id_procurement" data-mask="aa-9999-99-99-999999-a" placeholder="" value="{{ old('id_procurement') }}">
                    <span class="help-block">
                        <strong><p class="id_procurement"></p></strong>
                    </span>
                </div>
            </div>
            <div class="form-group row {{ $errors->has('offers_period_end') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-sm-2 control-label">Подать до</label>
                <div class="col-sm-8">
                    <input type="datetime" class="form-control" name="offers_period_end" id="offers_period_end" data-mask="9999-99-99 99:99" placeholder="" value="{{ old('offers_period_end') }}">
                    <span class="help-block">
                        <strong><p class="offers_period_end"></p></strong>
                    </span>
                </div>
            </div>
            <div class="form-group row {{ $errors->has('auction_period_end') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-sm-2 control-label">Время аукциона</label>
                <div class="col-sm-8">
                    <input type="datetime" class="form-control" name="auction_period_end" id="auction_period_end" data-mask="9999-99-99 99:99" placeholder="" value="{{ old('auction_period_end') }}"> 
                    <span class="help-block">
                        <strong><p class="auction_period_end"></p></strong>
                    </span>
                </div>
            </div>
            <div class="form-group row {{ $errors->has('amount') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-sm-2 control-label">Ожидаемая стоимость</label>
                <div class="col-sm-8">
                    <input type="number" step="any" class="form-control" name="amount" id="amount" placeholder="" value="{{ old('amount') }}"> <span class="help-block">
                        <strong><p class="amount"></p></strong>
                    </span>
                </div>
            </div>
            <div class="form-group row {{ $errors->has('users_id') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-sm-2 control-label">Ответственный Менеджер</label>
                <div class="col-sm-8">
                    <select class="form-control" name="users_id" id="users_id">
                        
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
            <div class="form-group row {{ $errors->has('subjects_id') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-sm-2 control-label">Предмет Закупки</label>
                <div class="col-sm-8">
                    <select class="form-control" name="subjects_id" id="subjects_id">
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
            <div class="form-group row {{ $errors->has('types_id') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-sm-2 control-label">Тип Закупки</label>
                <div class="col-sm-8">
                    <select class="form-control" name="types_id" id="types_id">
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
            <div class="form-group row {{ $errors->has('identifier') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-sm-2 control-label">ЕДРПО</label>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="identifier" id="identifier_id" placeholder="" value="{{ old('identifier') }}"> 
                    <span class="help-block">
                        <strong><p class="identifier"></p></strong>
                    </span>
                </div>
            </div>
            <div class="form-group row {{ $errors->has('types_id') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-sm-2 control-label">Тип Закупки</label>
                <div class="col-sm-8">
                    <select class="form-control" name="statuses_id" id="statuses_id">
                         @foreach($statuses as $status)
                            <option value="{{ $status->id }}">
                                {{$status->status}}
                            </option>
                        @endforeach
                    </select>
                    <span class="help-block">
                        <strong><p class="statuses_id"></p></strong>
                    </span>
                </div>
            </div>
            <div class="form-group row {{ $errors->has('description') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-sm-2 control-label">Описание</label>
                <div class="col-md-8">
                    <textarea class="form-control textarea-edit" name="description" id="description" placeholder="" value="{{ old('description') }}"></textarea>
                    <span class="help-block">
                        <strong><p class="description"></p></strong>
                    </span>
                </div>
            </div>
            <input type="hidden" id="procurement_id">
           <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Свернуть</button>
                        <button type="button" class="btn btn-primary editPrcourement">Изменить Закупку</button>
                    </div>
        </form>  

            </div>
        </div>
    </div>
</div>