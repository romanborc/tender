$('.results').click(function() {
    $('.bd-results-modal-lg').modal('show');
});


/* --================ CreateOrUpdate Results =============-- */
$(document).on('click', '.results', function() {
    var id = $(this).data("id");
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
        var data = {
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
    var id = $(this).data("id");

    $.get("/admin/edit/" + id, function(data) {
        $("#procurement_id").val(data.id);
        $("#customer").val(data.customer);
        $("#id_procurement").val(data.id_procurement);
        $("#offers_period_end").val(data.offers_period_end);
        $("#auction_period_end").val(data.auction_period_end);
        $("#amount").val(data.amount);
        $("#users").val(data.users_id);
        $("#subjects").val(data.subjects_id);
        $("#types").val(data.types_id);
        $("#identifier_id").val(data.identifier);
        $("#statuses").val(data.statuses_id);
        $("#description").val(data.description);
    });

    $('.editPrcourement').click(function() {
        var data = {
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