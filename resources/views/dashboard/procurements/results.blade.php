<div class="modal fade bd-results-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Добавить результаты Аукциона</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal result_form">
                        <input type="hidden" id="procurements_id" name="procurement_id">    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Свернуть</button>
                <button type="button" class="btn btn-danger deleteResults" data-id="{{ $result->procurement_id }}">Удалить Результаты</button>
                <button type="button" class="btn btn-primary saveResults">Изменить Результаты</button>
            </div>
        </div>
    </div>
</div>