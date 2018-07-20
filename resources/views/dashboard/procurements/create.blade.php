@extends('dashboard.layouts.app') @section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Добавить новую Закупку</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-9">
        <div class="ibox-content">
            <form class="form-horizontal lot" method="POST" action="/admin/procurements">
                {{ csrf_field() }}
                <div class="form-group row {{ $errors->has('customer') ? ' has-error' : '' }}">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Заказчик</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="customer" placeholder="" value="{{ old('customer') }}" required> @if ($errors->has('firstname'))
                        <span class="help-block">
                        <strong>{{ $errors->first('customer') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('id_procurement') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-sm-2 control-label">ID Закупки</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="id_procurement" data-mask="aa-9999-99-99-999999-a" placeholder="" value="{{ old('id_procurement') }}"> @if ($errors->has('id_procurement'))
                        <span class="help-block">
                        <strong>{{ $errors->first('id_procurement') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('offers_period_end') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-sm-2 control-label">Подать до</label>
                    <div class="col-sm-8">
                        <input type="datetime" class="form-control" name="offers_period_end" data-mask="99-99-9999 99:99" placeholder="" value="{{ old('offers_period_end') }}"> @if ($errors->has('offers_period_end'))
                        <span class="help-block">
                        <strong>{{ $errors->first('offers_period_end') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('auction_period_end') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-sm-2 control-label">Время аукциона</label>
                    <div class="col-sm-8">
                        <input type="datetime" class="form-control" name="auction_period_end" data-mask="99-99-9999 99:99" placeholder="" value="{{ old('auction_period_end') }}"> @if ($errors->has('auction_period_end'))
                        <span class="help-block">
                        <strong>{{ $errors->first('auction_period_end') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('amount') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-sm-2 control-label">Ожидаемая стоимость</label>
                    <div class="col-sm-8">
                        <input type="number" step="any" class="form-control" name="amount" placeholder="" value="{{ old('amount') }}"> @if ($errors->has('amount'))
                        <span class="help-block">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('users_id') ? ' has-error' : '' }}">
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
                        @if ($errors->has('users_id'))
                        <span class="help-block">
                        <strong>{{ $errors->first('users_id') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('subjects_id') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-sm-2 control-label">Предмет Закупки</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="subjects_id" id="subjects_id">
                            @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">
                                {{ $subject->subject }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('subjects_id'))
                        <span class="help-block">
                        <strong>{{ $errors->first('subjects_id') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('types_id') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-sm-2 control-label">Тип Закупки</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="types_id" id="types_id">
                            @foreach($types as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->type }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('types_id'))
                        <span class="help-block">
                        <strong>{{ $errors->first('types_id') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('identifier') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-sm-2 control-label">Код ЕДРПО</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="identifier" placeholder="" value="{{ old('identifier') }}"> @if ($errors->has('identifier'))
                        <span class="help-block">
                        <strong>{{ $errors->first('identifier') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('description') ? ' has-error' : '' }}">
                    <label class="col-sm-2 col-sm-2 control-label">Описание</label>
                    <div class="col-md-8">
                        <textarea class="form-control" name="description" id="description" placeholder="" value="{{ old('description') }}"></textarea>
                        @if ($errors->has('description'))
                        <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <a href="/admin" class="btn btn-white">Назад</a>
                        <button class="btn btn-primary" type="submit">+Добавить Закупку</button>
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
                                    <div class="title">
                                        <h1>Лот №1</h1>
                                    </div>
                                    <div class="form-group row clone_block {{ $errors->has('offers_period_end') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label">Подать до</label>
                                        <div class="col-sm-8">
                                            <input type="datetime" class="form-control" name="details[0][offers_period_end_lot]" data-mask="99-99-9999 99:99" placeholder="" value="{{ old('offers_period_end_lot') }}"> @if ($errors->has('offers_period_end'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('offers_period_end') }}</strong>
                        </span> @endif
                                        </div>
                                    </div>
                                    <div class="form-group row clone_block {{ $errors->has('auction_period_end') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label">Время аукциона</label>
                                        <div class="col-sm-8">
                                            <input type="datetime" class="form-control" name="details[0][auction_period_end_lot]" data-mask="99-99-9999 99:99" placeholder="" value="{{ old('auction_period_end_lot') }}"> @if ($errors->has('auction_period_end'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('auction_period_end') }}</strong>
                        </span> @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <a href="#" class="add"><i class="fas fa-plus fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="hr-lot"></div>
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
        <a href="#" class="btn btn-outline btn-default add_lot">+Добавить Лот</a>
    </div>
</div>
@endsection