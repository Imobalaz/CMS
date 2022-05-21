<?php include "includes/admin_header.php"; ?>
<?php include "functions.php"; 
if (!isset($_SESSION['status']) || $_SESSION['role'] != "Admin") {
    header("Location: ../");
}
if (isset($_GET['delete'])) {
        $row_id = $_GET['delete'];
    
        $delete_query = "DELETE FROM posts WHERE post_id = $row_id";
    
        $delete_query_result = mysqli_query($connection, $delete_query);

        header("Location: posts.php");
    
        if (!$delete_query_result) {
            die("Could not delete row" . mysqli_errno($connection));
        }
    }?>

 
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                   <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to ADMIN
                            <small>Subheading</small>
                        </h1>

                        <?php
                        if(isset($_GET['source'])) {
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }

                        switch($source) {
                            case 'add_post';
                            include 'includes/add_post.php';

                            break;

                            case 'edit_post';
                            include 'includes/edit_post.php';

                            break;


                            case 'edit_profile';
                            include 'edit_profile.php';

                            break;
                            
                            default:
                            include "includes/view_all_posts.php";
                            
                        }

                        ?>


                   </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php";?>
