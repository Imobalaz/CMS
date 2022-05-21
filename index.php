<?php include "includes/header.php";?>

    <!-- Navigation -->
<?php include "includes/navigation.php";?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>


                <?php 
                    $post_query = "SELECT * FROM posts WHERE post_status = 'published'";
                    $selected_posts = mysqli_query($connection, $post_query);
                    $index_post_count = mysqli_num_rows($selected_posts);

                    if ($index_post_count === 0) {
                        echo "<h1 class='text-center'>No Posts to See</h1>";
                    } elseif ($selected_posts) {
                        while ($post = mysqli_fetch_assoc($selected_posts)) {
                            $post_id = $post['post_id'];
                            $post_title = $post['post_title'];
                            $post_author = $post['post_author'];
                            $post_date = $post['post_date'];
                            $post_content = substr($post['post_content'], 0 , 100);
                            $post_image = $post['post_image'];

                            ?>
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
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

                <hr>
                    
            
                <?php    
                    }
                    } else {
                        die("Could not select" . mysqli_errno($connection));
                    }
                ?>
                <!-- First Blog Post -->
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>


        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php";?>
