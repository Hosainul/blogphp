<?php
require_once('../config/dbcon.php');
require_once('sidebar.php');
require_once('header.php');

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = mysqli_query($con, "SELECT `name`,`slug`,`status` FROM `categories` WHERE `id` = '$id'");
    $row = mysqli_fetch_assoc($result);
}
if(isset($_POST['save'])){

    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $status = $_POST['status'];
    $create = $_SESSION['u_id'];

    $result = mysqli_query($con, "UPDATE `categories` SET `name`='$name',`slug`='$slug',`status`='$status',`create_by`='$create' WHERE `id`='$id'");

    if($result){
        $success = "Category Updated Successfully!";
        header('location: manage_category.php');
    }
}
?>


<div class="row justify-content-md-center">
    <div class="col-md-6">
    <p class="text-success"><?php if(isset($success)){ echo $success; } ?></p>
        <div class="card">
            <div class="card-header">
                Update Category
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" class="form-control" name="name" id="name"
                        value="<?= $row['name']; ?>" onkeyup="s_slug(this.value)">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="slug" class="form-control" name="slug" id="slug"
                        value="<?= $row['slug']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="active"
                                <?= isset($row['status']) == '1' ? 'checked' : '' ?> value="1">
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status"
                                <?= isset($row['status']) == '0' ? 'checked' : '' ?> id="inactive" value="0">
                                <label class="form-check-label" for="inactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">Update Category</button>
                    </form>
            </div>
        </div>
    </div>
</div>



<?php require_once('footer.php'); ?>