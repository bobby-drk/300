$(function() {

    $('#record_ledger').click(function () {

        $('#frm_holder').hide();
        $('#ledger_loader').show();

        var url = "/api/v1/ledger/record?api_token=" + $('#api_token').val();
        var data_array = {
            "_token" : $('meta[name="csrf-token"]').attr('content') ,
            "amount" : $('#ledger_amount').val()
        };

        $.post(url, data_array, function (_response) {
console.log(_response);

        }).fail(function (_response) {

            $('#message').text(_response.responseJSON.error.message)
                .removeClass()
                .addClass("alert alert-danger")
                .show();

// console.log(_response.responseJSON);

// alert("message: " + _response.responseJSON.error.message);


        }).always(function (){
            $('#ledger_loader').hide();
            $('#frm_holder').show();
        });
    });

});