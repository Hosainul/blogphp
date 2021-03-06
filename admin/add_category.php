<?php
require_once('../config/dbcon.php');
require_once('sidebar.php');
require_once('header.php');

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $slug = $_POST['name'];
    $status = $_POST['status'];
    $create_by = $_SESSION['u_id'];

   $result =  mysqli_query($con, "INSERT INTO `categories`(`name`, `slug`, `status`, `create_by`) VALUES ('$name','$slug','$status','$create_by')");

   if($result){
       $success = "Category Added Successfully!";
   }
}

?>

<div class="row justify-content-md-center">
    <div class="col-md-6">
    <p class="text-success"><?php if(isset($success)){ echo $success; } ?></p>
        <div class="card">
            <div class="card-header">
                Add Category
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" class="form-control" name="name" id="name"
                        value="<?= isset($name) ? $name : '' ?>" onkeyup="s_slug(this.value)">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="slug" class="form-control" name="slug" id="slug"
                        value="<?= isset($name) ? $name : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="active" value="1">
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inactive" value="0">
                                <label class="form-check-label" for="inactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">Add Category</button>
                    </form>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>