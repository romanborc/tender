let count = 0;

$('.results').click(function() {
    $('.bd-results-modal-lg').modal('show');
});

/* --======= For block Create lot ========-- */

$(".add_lot").click(function() {
    $(".create_lot").toggle();
    $(".show_lot_modal").toggle();
});

$(".close-lot-modal").click(function() {
    $(".show_lot_modal").hide();
})

$(".back").click(function() {
    $(".create_lot").hide();
});

$(".save").click(function() {
    $(".create_lot").hide();
});
/* --======= END ========-- */


$(document).on('click', '.add', function() {
    count++;
    $(".tree").append('<div class="row" id="row' + count + '"><div class="col-lg-11">' +
        '<input type="hidden" name="details[' + count + '][id]" value="">' +
        '<div class="form-group row lot"><label class="col-sm-4 control-label">Название</label><div class="col-sm-8">' +
        '<input type=text class="form-control" name="details[' + count + '][name]" placeholder="" value=""></div></div>' +
        '<div class="form-group row lot"><label class="col-sm-4 control-label">Подать до</label><div class="col-sm-8">' +
        '<input type="datetime" class="form-control" name="details[' + count + '][offers_period_end_lot]" data-mask="99-99-9999 99:99" placeholder="" value=""></div></div>' +
        '<div class="form-group row lot"><label class="col-sm-4 control-label">Время аукциона</label><div class="col-sm-8">' +
        '<input type="datetime" class="form-control" name="details[' + count + '][auction_period_end_lot]" data-mask="99-99-9999 99:99" placeholder="" value=""></div></div>' +
        '<div class="form-group row lot"><label class="col-sm-4 control-label">Сумма Лота</label><div class="col-sm-8">' +
        '<input type="number" step="any" class="form-control" name="details[' + count + '][amount_lot]" placeholder="" value=""></div></div></div>' +
        '<div class="col-lg-1"><a href="#" class="remove" data-id="' + count + '"><i class="fas fa-times fa-2x"></i></a><a href="#" class="add">' +
        '<i class="fas fa-plus fa-2x"></i></a></div></div></div><div class="hr-lot"></div>');
});

$(document).on('click', '.remove', function() {
    let id = $(this).data('id');
    $('#row' + id + '').remove();
    $('.hr-lot').remove();
});

$(document).on('click', '.filter_statistic', function() {
    $.get('/admin/filter'); 
});

/* --================ Create Procurements =============-- */
$(document).on('click', '.createProcurements', function() {
    let data = $('.create').serializeArray();
    $.post('/admin/procurements', data, function(errors) {
        console.log(errors);
        if (errors.errors) {
            validations(errors);
        } else {
            window.location.href = "/admin";
        }
    });

});
/* --================ END =============-- */


/* --================ CreateOrUpdate Results =============-- */

$(document).on('click', '.add_lots_results', function() {
    $('.add_lots_results').remove();
    let total = $(".tree_results").length;
    total++;
    $('.result_form').append('<div class="tree_results"><div class="header_results"><h3>Лот №' + total + '</h3><div class="hr"></div></div>' +
        '<div class="row"><div class="col-sm-11"><div class="form-group row"><label class="col-sm-3 control-label">Результаты</label>' +
        '<div class="col-sm-9"><textarea class="form-control textarea-edit" name="results[' + total + '][results]" id="results" placeholder=""></textarea></div></div>' +
        '<div class="form-group row"><label class="col-sm-3 control-label">Победитель</label><div class="col-sm-5">' +
        '<input type="text" id="winners" name="results[' + total + '][winners]" class="form-control" placeholder="Наименование участника"></div>' +
        '<div class="col-sm-4">' +
        '<input type="hidden" id="result_id" name="results[' + total + '][id]">' +
        '<input type="number" step="any" id="winner_amount" name="results[' + total + '][winner_amount]" class="form-control" placeholder="Окончательня сумма"></div></div>' +
        '<div class="form-group row"><label class="col-sm-3 control-label">Статус Результата</label>' +
        '<div class="col-sm-9"><select class="form-control" name="results[' + total + '][statuses_id]" id="statuses_id">' +
        '<option value="0">Квалификация</option><option value="1">Выиграли</option><option value="2">Проиграли</option>' +
        '</select></div></div>' +
        '</div>' +
        '<div class="col-sm-1"><a href="#" class="remove_lots_results"><i class="fas fa-times fa-2x"></i></a>' +
        '<a href="#" class="add_lots_results"><i class="fas fa-plus fa-2x"></i></a></div></div></div>'
    );
});

$(document).on('click', '.results', function() {
    let id = $(this).data("id");
    $("#procurements_id").val(id);


    $.get("/admin/procurements/" + id, function(data) {
        $('.tree_results').remove();
        count = 0;
        $('.add_lots_results').remove();
        if (!isEmptyObject(data)) {
            $.each(data, function(i, e) {
                count++;
                str = e.winners.name.replace(/"/g, '&quot;');

                $('.result_form').append('<div class="tree_results"><div class="header_results"><h3>Лот №' + count + '</h3><div class="hr"></div></div>' +
                    '<div class="row"><div class="col-sm-11"><div class="form-group row"><label class="col-sm-3 control-label">Результаты</label>' +
                    '<div class="col-sm-9"><textarea class="form-control textarea-edit" name="results[' + count + '][results]" id="results" placeholder="">' + e.results + '</textarea></div></div>' +
                    '<div class="form-group row"><label class="col-sm-3 control-label">Победитель</label><div class="col-sm-5">' +
                    '<input type="text" id="winners" name="results[' + count + '][winners]" class="form-control" value="' + str + '" placeholder="Наименование участника"></div>' +
                    '<div class="col-sm-4">' +
                    '<input type="hidden" id="result_id" name="results[' + count + '][id]" value="' + e.id + '">' +
                    '<input type="number" step="any" id="winner_amount" name="results[' + count + '][winner_amount]" value="' + e.winner_amount + '" class="form-control" placeholder="Окончательня сумма"></div></div>' +
                    '<div class="form-group row"><label class="col-sm-3 control-label">Статус Результата</label>' +
                    '<div class="col-sm-9"><select class="form-control" name="results[' + count + '][statuses_id]" id="statuses_id'+ count +'">' +
                    '<option value="0">Квалификация</option><option value="1">Выиграли</option><option value="2">Проиграли</option>' +
                    '</select></div></div>' +
                    '</div>' +
                    '<div class="col-sm-1"><a href="#" class="remove_lots_results" data-id="' + e.id + '"><i class="fas fa-times fa-2x"></i></a>' +
                    '<a href="#" class="add_lots_results"><i class="fas fa-plus fa-2x"></i></a></div></div></div>'
                );
                $('#statuses_id'+ count +' option[value="' + e.statuses_id + '"]').prop('selected', true);
            });
        } else {
            $('.result_form').append('<a href="#" class="add_lots_results"><i class="fas fa-plus fa-2x"></i></a>');
        }

    });

    $('.saveResults').click(function() {
        let data = $('.result_form').serializeArray();
        console.log(data);
        $.post('/admin/results', data, function(errors) {
            window.location.reload();
        });
    });
});
/* --================ END =============-- */


/* --================ Update Procurements =============-- */
$(document).on('click', '.edit', function() {
    let id = $(this).data("id");

    $.get("/admin/edit/" + id, function(data) {
        let procurement = data.procurement;
        let procurementDeteils = data.procurementDeteils;

        /* --========Procurement Data ======= --*/
        $("#procurement_id").val(procurement.id);
        $("#customer").val(procurement.customer);
        $("#id_procurement").val(procurement.id_procurement);
        $("#offers_period_end").val(moment(procurement.offers_period_end).format('DD-MM-YYYY HH:mm'));
        $("#auction_period_end").val(moment(procurement.auction_period_end).format('DD-MM-YYYY HH:mm'));
        $("#amount").val(procurement.amount.toFixed(2));
        $("#users").val(procurement.users_id);
        $("#subjects").val(procurement.subjects_id);
        $("#types").val(procurement.types_id);
        $("#identifier_id").val(procurement.identifier);
        $("#statuses").val(procurement.statuses_id);
        $("#description").val(procurement.description);

        /* --========Procurement Lot Data ======= --*/
        $('.tree_lot div').remove();
        if (!isEmptyObject(procurementDeteils)) {
            $.each(procurementDeteils, function(i, e) {
                count++;
                $('.tree_lot').append('<div class="row" data-id="' + e.id + '"><div class="col-lg-11">' +
                    '<input type="hidden" name="details[' + count + '][id]" value="' + e.id + '">' +
                    '<div class="form-group row lot"><label class="col-sm-4 control-label">Название</label><div class="col-sm-8">' +
                    '<input type=text class="form-control" name="details[' + count + '][name]" placeholder="" value="' + e.name + '"></div></div>' +
                    '<div class="form-group row lot"><label class="col-sm-4 control-label">Подать до</label><div class="col-sm-8">' +
                    '<input type="datetime" class="form-control" name="details[' + count + '][offers_period_end_lot]" data-mask="99-99-9999 99:99" placeholder="" value="' + moment(e.offers_period_end_lot).format('DD-MM-YYYY HH:mm') + '"></div>' +
                    '<span class="help-block"><strong><p class="offers_period_end_lot"></p></strong></span></div>' +
                    '<div class="form-group row lot"><label class="col-sm-4 control-label">Время аукциона</label><div class="col-sm-8">' +
                    '<input type="datetime" class="form-control" name="details[' + count + '][auction_period_end_lot]" data-mask="99-99-9999 99:99" placeholder="" value="' + moment(e.auction_period_end_lot).format('DD-MM-YYYY HH:mm') + '"></div></div>' +
                    '<div class="form-group row lot"><label class="col-sm-4 control-label">Сумма Лота</label><div class="col-sm-8">' +
                    '<input type="number" step="any" class="form-control" name="details[' + count + '][amount_lot]" placeholder="" value="' + e.amount_lot.toFixed(2) + '"></div></div></div>' +
                    '<div class="col-lg-1"><a href="#" class="remove_lot"><span aria-hidden="true"><i class="fas fa-times fa-2x"></i></span></a></div></div><div class="hr-lot"></div>')

            });

        } else {
            $('.tree_lot').append('<div class="row"><div class="col-lg-12"><h1>Безлотовая Закупка</h1></div></div>');
        }
    });

    $('.editPrcourement').click(function() {
        let data = $('.update').serializeArray();
        $.post('/admin/procurement', data, function(errors) {
            if (errors) {
                validations(errors);
            } else {
                window.location.reload();
            }
        });
    });
});
/* --================ END =============-- */


/* --================ Delete Lots =============--*/
$(document).on('click', '.remove_lot', function() {
    let id = $(this).parent().parent().data('id');
    if (confirm("Вы действительно хотите удалить Лот?")) {
        $.delete('/admin/lots/' + id);
        $(this).parent().parent().remove();
        $('.hr-lot').remove();
    }
});
/* --================ END =============-- */


/* --================ Delete Procurement =============--*/
$(document).on('click', '.delitPrcourement', function() {
    let id = $('#procurement_id').val();
    if (confirm("Вы действительно хотите удалить Закупку?")) {
        $.delete('/admin/procurements/' + id, function() {
            window.location.reload();
        });
    }
});
/* --================ END =============-- */

/* --================ Delete Lots Results =============--*/
$(document).on('click', '.remove_lots_results', function() {
    let id = $(this).data('id');
    console.log(id);
    if (confirm("Вы действительно хотите удалить Результаты Лота?")) {
        $.delete('/admin/result/' + id);
        $(this).parent().parent().parent().remove();
    }
});
/* --================ END =============-- */

/* --================ Delete Results =============--*/
$(document).on('click', '.deleteResults', function() {
    let id = $(this).data('id');
    console.log(id);
    if (confirm("Вы действительно хотите удалить Результаты Лота?")) {
        $.delete('/admin/results/' + id, function() {
            window.location.reload();
        });
    }
});
/* --================ END =============-- */


/* --================ Validation for update or create Procurements =============--*/
let validations = function(errors) {
    $(".customer").text(errors.errors.customer);
    $(".id_procurement").text(errors.errors.id_procurement);
    $(".offers_period_end").text(errors.errors.offers_period_end);
    $(".auction_period_end").text(errors.errors.auction_period_end);
    $(".amounts").text(errors.errors.amount);
    $(".users_id").text(errors.errors.users_id);
    $(".subjects_id").text(errors.errors.subjects_id);
    $(".types_id").text(errors.errors.types_id);
    $(".identifier").text(errors.errors.identifier);
    $(".description").text(errors.errors.description);
}
/* --================ END =============-- */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.delete = function(url, data, callback, type) {
    if ($.isFunction(data)) {
        type = type || callback,
            callback = data,
            data = {}
    }

    return $.ajax({
        url: url,
        type: 'DELETE',
        success: callback,
        data: data,
        contentType: type
    });
}

function isEmptyObject(obj) {
    for (var i in obj) {
        if (obj.hasOwnProperty(i)) {
            return false;
        }
    }
    return true;
}



/* --================ Serialize Inputs =============-- */
/*let serializeControls = function() {
    let data = {};

    function inputObject(arr, val) {
        if (arr.lenght < 1)
            return val;

        let objkey = arr[0];
        if (objkey.slice(-1) == "]") {
            objkey = objkey.slice(0, -1);
        }
        let result = {};
        if (arr.length == 1) {
            result[objkey] = val;
        } else {
            arr.shift();
            var nestedVal = inputObject(arr, val);
            result[objkey] = nestedVal;
        }

        return result;
    }

    $.each($('input[name^="details').serializeArray(), function() {
        let val = this.value;
        let name = this.name.split("[");
        let obj = inputObject(name, val);
        $.extend(true, data, obj);
    });
    console.log(data);
}*/