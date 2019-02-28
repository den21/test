<?php
require_once 'Users.php';
$users = new Users();

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $where = " t_users.id = '$id'";
    $result = $users->getUsers($where);

}

if (isset($_POST['btn-update'])) {
    // variables for input data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $users->setName($name);
    $users->setEmail($email);
    $users->setCountry($country);
    $result = $users->updateUsers($id);

    if ($result) {
        header("Location: http://localhost:8888");
        die();
    }


}

?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<center>

    <form method="post">
        <table align="center">
            <tr>
                <td><input type="text" name="name" placeholder=" Name" value="<?= $result[0]['name']; ?>" required/>
                </td>
            </tr>
            <tr>
                <td><input type="email" name="email" placeholder="Email" value="<?= $result[0]['email']; ?>" required/>
                </td>
            </tr>
            <tr>
                <td><input type="text" name="country" placeholder="Country" value="<?= $result[0]['country']; ?>"
                           required/></td>
            </tr>
            <tr>
                <td>
                    <button type="submit" name="btn-update"><strong>UPDATE</strong></button>
                </td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>
