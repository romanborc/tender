$('.results').click(function() {
    $('#resultsModal').modal('show');
});

/*$(document).ready(function() {
    var i = $(".textarea").length + 1;
    $('#add').click(function() {
        $('<textarea class="form-control" name="results" id="results' + i + '" placeholder=""></textarea>')
            .fadeIn('slow')
            .appendTo('.add');
        i++;
    });
});
*/
/*function getResults() {
    $.get('/admin/results', function(data) {
        $(".results").each(function (i, v) {
             $('.result', $(this)).html(data[i].results);
             $('.participant', $(this)).html(data[i].participants.name);
        });  
    });
}*/


/* --================ CreateOrUpdate Results =============-- */
$(document).on('click', '.results', function() {
    var id = $(this).data("id");
    $.get("/admin/procurements/" + id, function(data) {
        $("#result_id").val(data.id);
        $("#results").val(data.results);
        //console.log(data);
        $("#participants_id").val(data.participants_id);
    });

    $('.saveresults').click(function() {
        var data = {
            procurement_id: id,
            id: $("#result_id").val(),
            results: $('#results').val(),
            participants_id: $('#participants_id').val(),
        };
        $.post('/admin/results', data, function() {
            $('#resultsModal').modal('hide');
            window.location.reload();
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
        $("#users_id").val(data.users_id);
        $("#subjects_id").val(data.subjects_id);
        $("#types_id").val(data.types_id);
        $("#identifier_id").val(data.identifier);
        $("#statuses_id").val(data.statuses_id);
        $("#description").val(data.description); 
         console.log(data);       
    });

    $('.editPrcourement').click(function() {
        var data = {
            id: $('#procurement_id').val(),
            customer: $('#customer').val(),
            id_procurement: $('#id_procurement').val(),
            offers_period_end: $('#offers_period_end').val(),
            auction_period_end: $('#auction_period_end').val(),
            amount: $('#amount').val(),
            users_id: $('#users_id').val(),
            subjects_id: $('#subjects_id').val(),
            types_id: $('#types_id').val(),
            identifier: $('#identifier_id').val(),
            statuses_id: $('#statuses_id').val(),
            description: $('#description').val(),
        };
        
        $.post('/admin/procurement', data, function(errors) {
            if(errors) {
                $(".customer").text(errors.errors.customer);
                $(".id_procurement").text(errors.errors.id_procurement);
                $(".offers_period_end").text(errors.errors.offers_period_end);
                $(".auction_period_end").text(errors.errors.auction_period_end);
                $(".amount").text(errors.errors.amount);
                $(".users_id").text(errors.errors.users_id);
                $(".subjects_id").text(errors.errors.subjects_id);
                $(".types_id").text(errors.errors.types_id);
                $(".identifier").text(errors.errors.identifier);
                $(".description").text(errors.errors.description);
            }else {
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
