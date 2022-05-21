<?php include "includes/header.php";?>

    <!-- Navigation -->
<?php include "includes/navigation.php";?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                     if (isset($_GET['p_id'])){
                        $category_id = $_GET['p_id'];

                        $category_name_query = "SELECT cat_title FROM categories WHERE cat_id = $category_id";
                        $category_name_result = mysqli_query($connection, $category_name_query);
                        confirm($category_name_result);
                        $category_name_array = mysqli_fetch_assoc($category_name_result);
                        $category_name = $category_name_array["cat_title"];
                        
                        $category_posts_query = "SELECT * FROM posts WHERE post_category_id = $category_id AND post_status = 'published'";

                        $category_posts_result = mysqli_query($connection, $category_posts_query);

                        confirm($category_posts_result);
                        if($category_posts_result) {
                            $count = mysqli_num_rows($category_posts_result);
                ?>

                <h1 class="page-header">
                    <?php echo $category_name . " Category";?>
                    <small>Secondary Text</small>
                </h1>

                <?php 
                            if(!$count) {
                                echo "<h1>No posts found</h1>";
                            } else {
                                while ($post = mysqli_fetch_assoc($category_posts_result)) {
                                    $post_id = $post['post_id'];
                                    $post_title = $post['post_title'];
                                    $post_author = $post['post_author'];
                                    $post_date = $post['post_date'];
                                    $post_content = substr($post['post_content'], 0 , 100);
                                    $post_image = $post['post_image'];
                                    
                ?>
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                        <hr>
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                        </a>
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>



                <?php
                                }
                            }
                        } else {
                            die("QUERY FAILED" . mysqli_errno($connection));
                        }
                    }
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>


        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php";?>