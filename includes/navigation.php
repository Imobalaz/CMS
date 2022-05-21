 <?php include "db.php"; ?>
 <?php include "admin/functions.php"; ?>
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Front</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php
                    $query = "SELECT * FROM categories";

                    $selected_rows = mysqli_query($connection, $query);

                    if ($selected_rows) {
                        while ($row = mysqli_fetch_assoc($selected_rows)) {
                            $category_id = $row['cat_id'];
                            $category_title = $row['cat_title'];
                            echo ("<li><a href='category.php?p_id=$category_id'>$category_title</a></li>");
                        }
                    } else {
                        die("Could not select" . mysqli_errno($connection));
                    }
                ?>

                <?php
                $admin_link = "#";
                if (isset($_SESSION['role'])) {
                    if($_SESSION['role'] === 'Admin') {
                        $admin_link = 'admin/index.php';
                    }
                }
                ?>


                <li>
                    <a href=<?php echo $admin_link; ?>>Admin</a>
                </li>
                <?php 
                if(!isset($_SESSION['status']))
                    echo "<li class=''><a href='sign_up.php'>Sign Up</a></li>";
                else
                    echo "<li class=''><a href='includes/logout.php'>Logout</a></li>";

                ?>



                    <!-- <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li> -->
                    </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>