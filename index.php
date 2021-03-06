<?php require_once 'header.php';
require_once 'config/dbcon.php';

$posts = mysqli_query($con, "SELECT `posts`.*, `users`.`name`
                            FROM `posts`
                            INNER JOIN `users` ON `posts`.`user_id`=`users`.`id` WHERE `posts`.`status`=1");

?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->

      <div class="col-md-8 mt-4">
        <!-- Blog Post -->
        <?php foreach ($posts as $post){ ?>
        <div class="card mb-4">
          <img class="card-img-top" src="uploads/posts/<?= $post['image']; ?>" style="width: 728px; height: 300px;" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title"><?= substr($post['title'], 0,150); ?></h2>
            <p class="card-text"><?= substr($post['content'], 0,250); ?></p>
            <a href="post.php?post=<?= $post['slug']; ?>" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted on <?= date('M d, Y', strtotime($post['created_at'])); ?>
            <a href="#"><?= $post['name']; ?></a>
          </div>
        </div>

        <?php } ?>

        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
          <li class="page-item">
            <a class="page-link" href="#">&larr; Older</a>
          </li>
          <li class="page-item disabled">
            <a class="page-link" href="#">Newer &rarr;</a>
          </li>
        </ul>

      </div>

      <!-- Sidebar Widgets Column -->
    
    <?php require_once 'sidebar.php'; ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php require_once 'footer.php'; ?>