$(function() {

    $('#record_score').click(function () {

        $('#message').html("");
        $('#frm_holder').hide();
        $('#score_loader').show();

        var url = "api/v1/score/record?api_token=" + $('#api_token').val();
        var data_array = {
            "_token" : $('meta[name="csrf-token"]').attr('content') ,
            "score" : $('#bowling_score').val()
        };
        
        $('#bowling_score').val("");
        
        $.post(url, data_array, function (_response) {


        $('#message').html("Your Score Has Been Recorded!")
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
            $('#score_loader').hide();
            $('#frm_holder').show();
        });
    });

});