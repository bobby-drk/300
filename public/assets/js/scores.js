$(function() {

    $('#record_score').click(function () {

        $('#frm_holder').hide();
        $('#score_loader').show();

        var url = "api/v1/score/record?api_token=" + $('#api_token').val();
        var data_array = {
            "_token" : $('meta[name="csrf-token"]').attr('content') ,
            "score" : $('#bowling_score').val()
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
            $('#score_loader').hide();
            $('#frm_holder').show();
        });
    });

});