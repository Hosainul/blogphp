<?php
require_once('../config/dbcon.php');
require_once('sidebar.php');
require_once('header.php');

$categories = mysqli_query($con, "SELECT `id`, `name` FROM `categories` WHERE `status`=1");


if(isset($_POST['save'])){

    $cat_id = $_POST['cat_id'];
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $user_id = $_SESSION['u_id'];

    $file = explode('.', $_FILES['image']['name']);
    $file_ext = end($file);
    $file_name = date('Ymhms.') . $file_ext;

    $result = mysqli_query($con, "INSERT INTO `posts`(`cat_id`, `title`, `slug`, `content`, `image`, `status`, `user_id`) VALUES ('$cat_id','$title','$slug','$content','$file_name','$status','$user_id')");

    if($result){
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/'.$file_name);
        $success = "Post Added Successfully!";
    }

}

?>

<div class="row justify-content-md-center">
    <div class="col-md-8">
    <p class="text-success"><?php if(isset($success)){ echo $success; } ?></p>
        <div class="card">
            <div class="card-header">
                Add Post
            </div>
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="cat_id">Category</label>
                        <select name="cat_id" id="cat_id" class="form-control" required>
                        <option value="">Select Category</option>
                        <?php
                            foreach ($categories as $category){
                        ?>
                            <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="title" class="form-control" name="title" id="title"
                        value="<?= isset($title) ? $title : '' ?>" onkeyup="s_slug(this.value)" onblur="s_slug(this.value)">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="slug" class="form-control" name="slug" id="slug"
                        value="<?= isset($slug) ? $slug : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content1" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">
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
                    <button type="submit" name="save" class="btn btn-primary">Add Post</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>