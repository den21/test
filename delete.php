<?php
require_once 'Users.php';
$users = new Users();
$id = $_POST['row_id'];

if($users->deleteUsers($id)){
    return "success";
}
return 'error';

?>