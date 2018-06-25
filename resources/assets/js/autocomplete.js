$(document).ready(function() {
    $("#won_by_price").autocomplete({
        source: function(request, response) {
            $.get("admin/search/participants", { results: request.term }, function(data) {
                response(data);
            });
        },
        select: function(event, ui) {
            event.preventDefault();
            $("#won_by_price").val(ui.item.label);
        },
            
        focus: function(event, ui) {
            event.preventDefault();
            $("#won_by_price").val(ui.item.label);
            
        }
    });
});

$(document).ready(function() {
    $("#winners").autocomplete({
        source: function(request, response) {
            $.get("admin/search/participants", { results: request.term }, function(data) {
                response(data);
            });
        },
        select: function(event, ui) {
            event.preventDefault();
            $("#winners").val(ui.item.label);
            $("#winners_name_id").val(ui.item.value);           

        },
        focus: function(event, ui) {
            event.preventDefault();
            $("#winners").val(ui.item.label);
        }
    });
});