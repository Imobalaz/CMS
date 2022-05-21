<?php include "includes/header.php";?>

    <!-- Navigation -->
<?php include "includes/navigation.php";?>

<?php
               
                if(isset($_POST['submit'])) {

                    if(isset($_SESSION['status'])) {
                        $comment_author = $_SESSION['username'];
                        $comment_email =  $_SESSION['email'];
                    } else {
                        $comment_author = $_POST['comment_author'];
                        $comment_email =  $_POST['comment_email'];
                    }
                    $comment_content =  $_POST['comment_content'];
                    $comment_post_id = $_GET['p_id'];


                    if(!$comment_author) {
                        $comment_info = "Comment must be submitted with a name";

                    }elseif(!$comment_content) {
                        $comment_info = "Write a comment";
                    }else{
                        $comment_upload_query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_date) 
                                                VALUES ($comment_post_id, '$comment_author', '$comment_email', '$comment_content', now())";
    
                        $comment_upload_result = mysqli_query($connection, $comment_upload_query);
    
                        confirm($comment_upload_result);
    
                        $comment_info = "Your comment has been successfully uploaded";
                    }



                }
                ?>


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

                    if(isset($_GET['p_id'])) {
                        $post_id = $_GET['p_id'];
                        $post_query = "SELECT * FROM posts WHERE post_id = $post_id";
                        $selected_post = mysqli_query($connection, $post_query);
    
                        if ($selected_post) {
                        $post = mysqli_fetch_assoc($selected_post);
                        $post_title = $post['post_title'];
                        $post_author = $post['post_author'];
                        $post_date = $post['post_date'];
                        $post_content = $post['post_content'];
                        $post_image = $post['post_image'];
                        }
                    }
                    ?>
                        <h2>
                            <a href=""><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                        <hr>
                        <p><?php echo $post_content ?></p>

                <hr>
                <!-- First Blog Post -->

                <!-- Blog Comments -->
                

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <?php
                        if(!isset($_SESSION['status'])){
                        echo "<div class='form-group'><label for='comment_author'>Your Name</label><input type='text' name='comment_author' class='form-control'></div>
                        <div class='form-group'><label for='comment_email'>Your Email</label><input type='email' name='comment_email' class='form-control'></div>";
                        }
                        ?>
                        <div class="form-group">
                            <label for="comment_content">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                        <?php if(isset($comment_info)) {echo "<p>$comment_info<p>";} ?>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php
                $get_approved_comments_query = "SELECT * FROM comments WHERE comment_status = 'Approved' AND comment_post_id = $post_id ORDER BY comment_id DESC";
                $get_approved_comments_result = mysqli_query($connection, $get_approved_comments_query);
                confirm($get_approved_comments_result);
                while($approved_comments = mysqli_fetch_assoc($get_approved_comments_result)){
                    $author = $approved_comments['comment_author'];
                    $date = $approved_comments['comment_date'];
                    $content = $approved_comments['comment_content'];
                    ?>

                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $author; ?>
                                    <small><?php echo $date; ?></small>
                                </h4>
                                <?php echo $content; ?>
                            </div>
                        </div>

                <?php    
                }
                ?>


                <!-- Comment -->
                <!-- <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        Nested Comment
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        End Nested Comment
                    </div>
                </div> -->
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>


        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php";?>
