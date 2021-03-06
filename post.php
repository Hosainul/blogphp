<?php require_once 'header.php';
require_once 'config/dbcon.php';


if(isset($_GET['post'])){
    $slug = $_GET['post'];

    $post = mysqli_query($con, "SELECT `posts`.*, `users`.`name`
                                FROM `posts`
                                INNER JOIN `users` ON `posts`.`user_id`=`users`.`id` WHERE `posts`.`slug`='$slug' AND `posts`.`status`=1");

    $row = mysqli_fetch_assoc($post);
}

?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

    <div class="col-lg-8">

<!-- Title -->
<h1 class="mt-4"><?= $row['title'] ?></h1>

<!-- Author -->
<p class="lead">
  by
  <a href="#"><?= $row['name'] ?></a>
</p>

<hr>

<!-- Date/Time -->
<p>Posted on <?= date('M d, Y', strtotime($row['created_at'])); ?></p>

<hr>

<!-- Preview Image -->
<img class="img-fluid rounded" src="uploads/posts/<?= $row['image']; ?>" style="width: 728px; height: 300px;" alt="">

<hr>

<!-- Post Content -->
<?= $row['content'] ?>

<blockquote class="blockquote">
  <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
  <footer class="blockquote-footer">Someone famous in
    <cite title="Source Title">Source Title</cite>
  </footer>
</blockquote>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>

<hr>


</div>

      <!-- Sidebar Widgets Column -->
    
    <?php require_once 'sidebar.php'; ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php require_once 'footer.php'; ?>