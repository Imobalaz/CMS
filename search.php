<?php include "includes/header.php";?>

    <!-- Navigation -->
<?php include "includes/navigation.php";?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Search Page
                    <small>Secondary Text</small>
                </h1>

                <?php 
                    if (isset($_POST['submit'])){
                        $search = $_POST['search'];
                        
                        $search_query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published'";

                        $search_result = mysqli_query($connection, $search_query);

                        if($search_result) {
                            $count = mysqli_num_rows($search_result);

                            if(!$count) {
                                echo "<h1>No posts found</h1>";
                            } else {
                                while ($post = mysqli_fetch_assoc($search_result)) {
                                    $post_title = $post['post_title'];
                                    $post_id = $post['post_id'];
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