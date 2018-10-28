<?php
session_start();

print_r($_SESSION);

if(isset($_SESSION['user'])){


    echo "This would redirect to login page.";

} else {

    echo "Wasn't logged in anyway";

}

?>