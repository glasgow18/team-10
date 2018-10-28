// MAKE SURE THE DOCUMENT IS READY
$(document).ready(function () {

    // SUBMIT THE FORM
    $('#username').blur(function (e) {

        // SETUP THE DATA TO SEND
        var formData = {
            username: $('#username').val()
        };

        // MAKE POST REQUEST TO RELEVANT PAGE
        $.post('check-username.php', formData, function (resp) {


            // IF ITS SUCCESSFUL
            if (resp.status == "success") {

                //  POTENTIALLY DO NOTHING


            } else {

                // UPDATE THE UI TO SAY CANT USE THIS NAME
                // TODO: UPDATE UI
                console.log(resp);


            }

        }, 'json');

    });


});