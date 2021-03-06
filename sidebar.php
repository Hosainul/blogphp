<?php

$categories = mysqli_query($con, "SELECT * FROM `categories` WHERE `status` = 1");
?>

<div class="col-md-4">

<!-- Search Widget -->
<div class="card my-4">
  <h5 class="card-header">Search</h5>
  <form action="search.php">
    <div class="card-body">
      <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search for...">
          <span class="input-group-append">
            <button class="btn btn-secondary" type="submit">Go!</button>
          </span>
        </div>
    </div>
  </form>
</div>

<!-- Categories Widget -->
<div class="card my-4">
  <h5 class="card-header">Categories</h5>
  <div class="card-body">
    <div class="row">
      <?php foreach ($categories as $category) { ?>
        <div class="col-lg-6">
            <ul class="list-unstyled mb-0">
              <li>
                <a href="cat_post.php?cat_post=<?= $category['slug']; ?>"><?= $category['name']; ?></a>
              </li>
            </ul>
          </div>
      <?php } ?>
    </div>
  </div>
</div>

<!-- Side Widget -->
<div class="card my-4">
  <h5 class="card-header">Side Widget</h5>
  <div class="card-body">
    You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
  </div>
</div>

</div>