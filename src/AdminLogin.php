<?php
const PIN = "1234";

if(isset($_POST['btnAdminLogin']))
{
    if($_POST['adminPin'] == PIN)
    {
        $_SESSION['isAdminLoggedIn'] = true;
        header('Location: index.php?action=adminindex');
    }
    else 
    {
        echo 'Incorrect Admin Pin!';
        header("refresh:1;url=index.php?action=adminindex");
    }
}