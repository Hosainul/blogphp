<?php
require_once('../config/dbcon.php');
require_once('sidebar.php');
require_once('header.php');

$result  = mysqli_query($con, "SELECT * FROM `categories`");
$user = mysqli_query($con, "SELECT c.`id`, c.`name` AS cat_name, c.`slug`, c.`status`, `users`.`name`
                            FROM `categories` c
                            LEFT JOIN `users`
                            ON c.`create_by`=`users`.`id`");


?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Create By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($user)) { ?>
                    <tr>
                    <td><?= $row['cat_name']?></td>
                    <td><?= $row['slug']?></td>
                    <td>
                        <?php if($row['status'] == 1){ ?>
                            <p style="color: green">Active</p>
                        <?php }else{ ?>
                            <p style="color: red">Inactive</p>
                        <?php } ?>
                    </td>
                    <td><?= $row['name']?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="update_category.php?edit=<?= $row['id'];?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="delete_category.php?categorydelete=<?= $row['id'];?>"
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