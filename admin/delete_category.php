<?php
require_once('../config/dbcon.php');
if(isset($_GET['categorydelete'])){
    $id = $_GET['categorydelete'];

    mysqli_query($con, "DELETE FROM `categories` WHERE `id` = '$id'");

    header('location: manage_category.php');

}

?>