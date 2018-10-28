// MAKE SURE THE DOCUMENT IS READY
$(document).ready(function () {

    // CHCK THE USERNAME ON BLUE
    $('#registration').submit(function (e) {

        
        e.preventDefault();
        console.log('This ran');
        

        // SETUP THE DATA TO SEND
        // var formData = {
        //     username: $('#email-signup').val()
        // };

        var formData = $(this).serialize();
        console.log(formData);

        console.log('THIS RAN');

        // MAKE POST REQUEST TO RELEVANT PAGE
        $.post('register.php', formData, function (resp) {

            console.log('runs the ajax');

            // IF ITS SUCCESSFUL
            if (resp.status == "success") {

                console.log(resp);
                
                // UPDATE USER TO LET THEM KNOW
                alert('Successfully registered');

                // CLEAR THE FORM
                $(this).find('.feedback-box').addClass('success');
                $(this).find('.feedback-box').css('display','block');


            } else {

                // UPDATE THE UI TO SAY CANT USE THIS NAME
                // TODO: UPDATE UI
                console.log(resp);
                var errorString = '';

                resp.errors.forEach(function(x){
                    errorString += x;
                })
                
                alert(errorString);
                $(this).find('.feedback-box').text(resp.errors[0]);
                // $('#email-signup-notifiation').text();
                $(this).find('.feedback-box').addClass('success');
                $(this).find('.feedback-box').css('display','block');


            }

        }, 'json');

    });


});