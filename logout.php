<?php

session_start();

// BIN ANY USER DATA FROM THE SESSION
unset($_SESSION['user']);

// TODO: REDIRECT TO LOGIN PAGE AUTOMATICALLY
// header("Location: {{LOGIN URL goeS HERE}})
echo "<p>This would redirect to the login page now.";


?>