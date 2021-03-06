<?php
require_once('../config/dbcon.php');
if(isset($_GET['postdelete'])){
    $id = $_GET['postdelete'];

    mysqli_query($con, "DELETE FROM `posts` WHERE `id` = '$id'");

    header('location: manage_post.php');

}

?>