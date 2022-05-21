<?php include "includes/admin_header.php"; ?>
<?php include "functions.php"; 
if (!isset($_SESSION['status']) || $_SESSION['role'] != "Admin") {
    header("Location: ../");
}
?>


<?php

$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
$user_firstname = $_SESSION['firstname'];
$user_lastname = $_SESSION['lastname'];
$user_email = $_SESSION['email'];
$user_role = $_SESSION['role'];
$user_image = $_SESSION['image'];

if($user_image) {
    $profile_image = "../images/$user_image";
} else {
    $profile_image = "../images/blank-profile-picture-png.png";
}


$get_user_posts_query = "SELECT * FROM posts WHERE post_author = '$username'";
$get_user_posts_result = mysqli_query($connection, $get_user_posts_query);
confirm($get_user_posts_result);
$post_count = mysqli_num_rows($get_user_posts_result);
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper" class="profile-container" style="padding: 0; background: #333;">

                <!-- Page Heading -->
                <div class="profile-hero">
                    <div class="profile-pic-container">
                        <img src=<?php echo $profile_image; ?> alt="">
                    </div>
                </div>

                <div class="user-info">
                    <div class="edit-btn">
                        <button class="btn btn-primary"><a href="posts.php?source=edit_profile">Edit Profile</a></button>
                    </div>
                    <h3><?php echo $username; ?></h2>
                    <p><i><?php echo $user_firstname . " " . $user_lastname; ?></i></p>
                    <p><i><?php echo $user_email; ?></i></p>
                    <p><i><?php echo $user_role; ?></i></p>
                </div>
                
                <div class="posts-section">
                    <h2>Posts</h2>
                    <div class="posts">

                    <?php
                    if ($post_count == 0) {
                        echo "<h3>No posts yet</h3>";
                    } else {
                        while ($post = mysqli_fetch_assoc($get_user_posts_result)) {
                            $post_image = "../images/" . $post['post_image'];
                            $post_id = $post['post_id'];
                            $post_date = $post['post_date'];
                            $post_title = $post['post_title'];
                            $post_status = $post['post_status'];
                            ?>
                            <div class="post">
                                <div class="post-image">
                                    <img src=<?php echo $post_image; ?> alt="">
                                </div>
                                <div class="post-info">
                                    <p><a href="../post.php?p_id=<?php echo $post_id; ?>" ><?php echo $post_title; ?></a></p>
                                    <p><?php echo $post_status; ?></p>
                                    <p><?php echo $post_date; ?></p>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    ?>
                       
                    </div>
                </div>



        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php";
