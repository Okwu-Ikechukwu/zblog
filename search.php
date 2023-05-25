<?php
require 'partials/header.php';

if (isset($_GET['search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>


<?php if (mysqli_num_rows($posts) > 0) : ?>
<section class="posts section-extra-margin">
<div class="container posts-container">
     <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
         <article class="post">
                 <div class="post-thumb">
                     <img src="img/<?= $post['thumbnail'] ?>">
                 </div>
                 <div class="post-info">
                     <?php
                         // fetch category from categories table using category_id of post
                         $category_id = $post['category_id'];
                         $category_query = "SELECT * FROM categories WHERE id=$category_id";
                         $category_result = mysqli_query($connection, $category_query);
                         $category = mysqli_fetch_assoc($category_result);
                     ?>
                     <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id']?>" class="category-button"><?= $category['title']?></a>
                     <h3 class="post-title">
                         <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                     </h3>
                     <p class="post-body">
                          <?= substr($post['body'], 0, 150)?>....
                     </p>
                     <div class="post-author">
                         <?php
                             // fetch author from categories table using author_id of post
                             $author_id = $post['author_id'];
                             $author_query = "SELECT * FROM users WHERE id=$author_id";
                             $author_result = mysqli_query($connection, $author_query);
                             $author = mysqli_fetch_assoc($author_result);
                         ?>
                             <div class="post-author-avatar">
                             <img src="img/<?= $author['avatar'] ?>">
                             </div>
                             <div class="post-author-info">
                                 <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                             <small><?= date("M d, Y - H:i", strtotime($post['date_time']))?></small>
                             </div>
                     </div>
                 </div>
         </article>
     <?php endwhile ?>
</div>
</section>
<?php else : ?>
    <div class="alert-message error lg section-extra-margin">
        <p>No Posts Found For This Search</p>
    </div>
<?php endif ?>
<!-- end of posts -->

  <section class="category-buttons">
       <div class="container category-buttons-container">
           <?php
               $all_category_query = "SELECT * FROM categories";
               $all_category = mysqli_query($connection, $all_category_query);
           ?>
           <?php while ($category = mysqli_fetch_assoc($all_category)) : ?>
                <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category-button"><?= $category['title'] ?></a>
           <?php endwhile ?>
       </div>
   </section>
<!-- end of category buttons -->


<?php include 'partials/footer.php'?>