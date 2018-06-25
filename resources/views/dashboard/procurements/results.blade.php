<div class="modal fade bd-results-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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

                        <div class="form-group row">
                            <div class="col-sm-3">
                                Выиграл по цене
                            </div>
                            <div class="col-sm-5">
                                <input type="text" id="won_by_price" name="won_by_price" class="form-control" placeholder="Наименование участника">
                                <span class="help-block">
                                    <strong><p class="participants_name"></p></strong>
                                </span>
                            </div>
                            <div class="col-sm-4">
                                <input type="number" id="amounts" step="any" name="amounts" class="form-control" placeholder="Окончательня сумма">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col-sm-3">
                                Победитель
                            </div>
                            <div class="col-sm-5">
                                <input type="text"  id="winners" name="winners" class="form-control" placeholder="Наименование участника">
                                <input type="hidden" id="winners_name_id">
                            </div>
                            <div class="col-sm-4">
                                <input type="number" step="any" id="winner_amount" name="winner_amount" class="form-control" placeholder="Окончательня сумма">
                            </div>
                        </div>                      
                    <input type="hidden" id="result_id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Свернуть</button>
                        <button type="button" class="btn btn-primary saveresults">Записать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>