$(function() {

    $('#record_ledger').click(function () {

        $('#message').html("");
        $('#frm_holder').hide();
        $('#ledger_loader').show();

        var url = "/api/v1/ledger/record?api_token=" + $('#api_token').val();
        var participates =  $("input[name='debtor']:checked").map(function(){
            return this.value;
        }).get()
        var amount = $('#ledger_amount').val();
        var data_array = {
            "_token" : $('meta[name="csrf-token"]').attr('content') ,
            "amount" : amount,
            "credit_type" : $('#credit_type').val(),
            "debtor" : participates,
        };
        $('#ledger_amount').val("");

        $.post(url, data_array, function (_response) {

            $('#message').html("$"+ amount + " divided by " + _response.data.group_size + " participants is " + _response.data.share)
                .removeClass()
                .addClass("alert alert-success")
                .show();
        }).fail(function (_response) {
            var message = _response.responseJSON.error.message;

            if (typeof _response.responseJSON.error.error_data != "undefined") {
                for(i in _response.responseJSON.error.error_data) {
                    message += "<div class='indent_offset_l'>" + _response.responseJSON.error.error_data[i] + "</div>";
                }
            }

            $('#message').html(message)
                .removeClass()
                .addClass("alert alert-danger")
                .show();

        }).always(function (){
            $('#ledger_loader').hide();
            $('#frm_holder').show();
        });
    });

    $('#add_guest').click(function () {
        var d = new Date();
        var s = d.getSeconds();
        var m = d.getMilliseconds();

        $('.user_list').last().after("<div class='user_list vertical_offset_s indent_offset_l'><input id='guest_"+s+m+"' checked='checked' name='debtor' type='checkbox' value='guest'> <label for='guest_"+s+m+"'> <input type='text' class='form-control input-sm' name='guest_"+s+m+"' placeholder='Guest' /></label></div>");


    });
});