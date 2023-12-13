<?php
session_start();
 require "backend.php";
if (isset($_POST['choice'])) {
    switch ($_POST['choice']) {
        case 'login':
            $backend = new backend();
            echo $backend->dologin($_POST['username'],$_POST['password']);
            break;
        case 'register':
            $backend = new backend();
            echo $backend->doregister($_POST['userid'],$_POST['fullname'],$_POST['username'],$_POST['password'],$_POST['address'],$_POST['email']);
            break;
        case 'getuserID':
            $backend = new backend();
            echo $backend->viewUser();
            break;
    }
}
?>