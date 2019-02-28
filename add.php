<?php
require_once 'Users.php';
$users = new Users();

if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['country']))
{
    // variables for input data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $users->setName($name);
    $users->setEmail($email);
    $users->setCountry($country);
    $result = $users->addUsers();

    if ($result) {
        header("Location: http://localhost:8888");
        die();
    }

}
?>
