<?php
require_once('../config/dbcon.php');
require_once('sidebar.php');
require_once('header.php');

$result  = mysqli_query($con, "SELECT * FROM `categories`");
$post = mysqli_query($con, "SELECT `posts`.*, `users`.`name`, `categories`.`name` AS cat_name
                            FROM `posts`
                            INNER JOIN `users` ON `posts`.`user_id`=`users`.`id`
                            INNER JOIN `categories` ON `posts`.`cat_id`=`categories`.`id`");


?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Posts</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Create By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($post)) { ?>
                    <tr>
                    <td><?= $row['title']?></td>
                    <td><img src="../uploads/posts/<?= $row['image']?>" style="width: 120px; height: 90px;" alt=""></td>
                    <td><?= $row['cat_name']?></td>
                    <td>
                        <?php if($row['status'] == 1){ ?>
                            <p style="color: green">Active</p>
                        <?php }else{ ?>
                            <p style="color: red">Inactive</p>
                        <?php } ?>
                    </td>
                    <td><?= $row['name']?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="update_post.php?edit=<?= $row['id'];?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="delete_post.php?postdelete=<?= $row['id'];?>"
                        onclick="confirm('Are you sure want to delete this category?')">Delete</a>
                    </td>
                </tr>
                <?php
                } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>