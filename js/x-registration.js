// MAKE SURE THE DOCUMENT IS READY
$(document).ready(function () {

    // CHCK THE USERNAME ON BLUE
    $('#email-signup').blur(function (e) {

        var notification = $('#email-signup-notifiation');
        var emailBox = $('#email-signup');

        notification.val('');
        

        // SETUP THE DATA TO SEND
        var formData = {
            username: $('#email-signup').val()
        };

        console.log('THIS RAN');

        // MAKE POST REQUEST TO RELEVANT PAGE
        $.post('check-username.php', formData, function (resp) {


            // IF ITS SUCCESSFUL
            if (resp.status == "success") {

                //  POTENTIALLY DO NOTHING
                $('#email-signup-notification').text(resp.errors[0]);


            } else {

                // UPDATE THE UI TO SAY CANT USE THIS NAME
                // TODO: UPDATE UI
                console.log(resp);
                $('#email-signup-notifiation').text(resp.errors[0]);


            }

        }, 'json');

    });


});