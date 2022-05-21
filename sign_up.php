<?php include "includes/header.php";?>

    <!-- Navigation -->
<?php include "includes/navigation.php";?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Sign Up
                    <small>Secondary Text</small>
                </h1>

                <?php
                    $create_user_info = '';

                    if (isset($_POST['create_user'])) {
                        create_user();
                    }

                ?>






                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="user_firstname">Firstname</label>
                        <input type="text" class="form-control" name="user_firstname">
                    </div>
                    <div class="form-group">
                        <label for="user_lastname">Lastname</label>
                        <input type="text" class="form-control" name="user_lastname">
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input type="email" class="form-control" name="user_email">
                    </div>
                    <div class="form-group">
                        <label for="user_password">Password</label>
                        <input type="password" class="form-control" name="user_password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_user_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_user_password">
                    </div>
                    
                    <div class="form-group">
                        <label for="user_image">Profile Photo</label>
                        <input type="file" name="user_image">
                    </div>
                    
                    <input value="Sign Up" type="submit" class="btn btn-primary" name="create_user">

                    <?php
                        if ($create_user_info) {
                            echo "<p>$create_user_info</p>";
                        } 
                    ?>

                </form>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>


        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php";?>