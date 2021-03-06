<?php require_once 'header.php';
require_once 'config/dbcon.php';

if(isset($_GET['cat_post'])){
    $slug = $_GET['cat_post'];
    $result = mysqli_query($con, "SELECT `id` FROM `categories` WHERE `slug`='$slug'");
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $posts = mysqli_query($con, "SELECT `posts`.*, `users`.`name` FROM `posts`,`users`
                                WHERE `posts`.`cat_id`='$id' AND `posts`.`user_id`=`users`.`id` and `posts`.`status`=1
                                ORDER BY `posts`.`id` DESC");
}

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
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
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