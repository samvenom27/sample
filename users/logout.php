<?php 
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    header('Location:../login.php?logmsg=<p class="logoff">Logged-off sucessfully.</p>');
