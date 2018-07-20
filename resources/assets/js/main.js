$('.results').click(function() {
    $('.bd-results-modal-lg').modal('show');
});

/* --======= For block Create lot ========-- */

    $(".add_lot").click(function() {
        $(".create_lot").toggle();
    });

    $(".back").click(function() {
        $(".create_lot").hide();
    }); 

    let count = 1;
    $(document).on('click', '.add', function() {
        count++;
        let htmlAppend = '<div class="row" id="row'+ count +'"><div class="col-lg-11"><div class="title"><h1>Лот №'+ count +'</h1></div><div class="form-group row"><label class="col-sm-4 control-label">Подать до</label><div class="col-sm-8"><input type="datetime" class="form-control" name="details[' + count + '][offers_period_end_lot]" data-mask="99-99-9999 99:99" placeholder="" value=""></div></div><div class="form-group row"><label class="col-sm-4 control-label">Время аукциона</label><div class="col-sm-8"><input type="datetime" class="form-control" name="details[' + count + '][auction_period_end_lot]" data-mask="99-99-9999 99:99" placeholder="" value=""></div></div></div><div class="col-lg-1"><a href="#" class="remove" data-id="' + count + '"><i class="fas fa-times fa-2x"></i></a><a href="#" class="add"><i class="fas fa-plus fa-2x"></i></a></div></div><div class="hr-lot"></div></div>';
        $(".tree").append(htmlAppend);
        localStorage.setItem("htmlAppend", htmlAppend);
    });

    $(document).on('click', '.save', function() {
        var data = {};
        $("input[name=details]").serializeArray().map(function(i){
            data[i.name] = i.value;
        }); 
        console.log(data);
    });

    let htmlAppend = localStorage.getItem("htmlAppend");
    console.log(htmlAppend);
    if(htmlAppend) {
         $(".tree").append(htmlAppend);
    }

    $(document).on('click', '.remove', function() {
        let id = $(this).data('id');
        $('#row'+ id +'').remove();
        $('.hr-lot').remove();
    });






/* --================ CreateOrUpdate Results =============-- */
$(document).on('click', '.results', function() {
    let id = $(this).data("id");
    $.get("/admin/procurements/" + id, function(data) {
        $("#result_id").val(data.id);
        $("#results").val(data.results);
        $("#won_by_price").val(data.won_by_price.name);
        $("#winners").val(data.winners.name);
        $("#amounts").val(data.amount);
        $("#winner_amount").val(data.winner_amount);

        console.log(data);
    });

    $('.saveresults').click(function() {
        let data = {
            procurement_id: id,
            id: $("#result_id").val(),
            results: $('#results').val(),
            won_by_price: $('#won_by_price').val(),
            amounts: $('#amounts').val(),
            winners: $('#winners').val(),
            winner_amount: $('#winner_amount').val(),
        };
        console.log(data);
        $.post('/admin/results', data, function(errors) {
            if (errors) {
                $(".participants_name").text(errors.errors.won_by_price);
            } else {
                window.location.reload();
            }
        });
    });
});


/* --================ Update Procurements =============-- */
$(document).on('click', '.edit', function() {
    let id = $(this).data("id");

    $.get("/admin/edit/" + id, function(data) {
        $("#procurement_id").val(data.id);
        $("#customer").val(data.customer);
        $("#id_procurement").val(data.id_procurement);
        $("#offers_period_end").val(moment(data.offers_period_end).format('DD-MM-YYYY HH:mm'));
        $("#auction_period_end").val(moment(data.auction_period_end).format('DD-MM-YYYY HH:mm'));
        $("#amount").val(data.amount);
        $("#users").val(data.users_id);
        $("#subjects").val(data.subjects_id);
        $("#types").val(data.types_id);
        $("#identifier_id").val(data.identifier);
        $("#statuses").val(data.statuses_id);
        $("#description").val(data.description);
    });


    $('.editPrcourement').click(function() {
        let data = {
            id: $('#procurement_id').val(),
            customer: $('#customer').val(),
            id_procurement: $('#id_procurement').val(),
            offers_period_end: $('#offers_period_end').val(),
            auction_period_end: $('#auction_period_end').val(),
            amount: $('#amount').val(),
            users_id: $('#users').val(),
            subjects_id: $('#subjects').val(),
            types_id: $('#types').val(),
            identifier: $('#identifier_id').val(),
            statuses_id: $('#statuses').val(),
            description: $('#description').val(),
        };

        $.post('/admin/procurement', data, function(errors) {
            if (errors) {
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
            } else {
                window.location.reload();
            }


        });
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});