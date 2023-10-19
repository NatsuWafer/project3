<?php

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $password = $_POST["register_password"];
    $re_password = $_POST["re_password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';


    if (emptyInputSignup($name, $email, $username, $password, $re_password) !== false) {
        header("location: ../essarate/signup.php?error=emptyinput");
        exit();
    }

    if (inavlidUsername($username) !== false) {
        header("location: ../essarate/signup.php?error=invalidusername");
        exit();
    }

    if (inavlidEmail($email) !== false) {
        header("location: ../essarate/signup.php?error=invalidemail");
        exit();
    }

    if (passwordMatch($password, $re_password) !== false) {
        header("location: ../essarate/signup.php?error=passwordsdontmatch");
        exit();
    }

    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../essarate/signup.php?error=usernametaken");
        exit();
    }


    createUser($conn, $name, $email, $username, $password);

}
else {
    header("location: ../essarate/signup.php");
    exit();
}