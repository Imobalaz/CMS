<?php include "includes/admin_header.php"; ?>
<?php include "functions.php"; 
if (!isset($_SESSION['status']) || $_SESSION['role'] != "Admin") {
    header("Location: ../");
}
if (isset($_GET['delete'])) {
        $row_id = $_GET['delete'];
    
        $delete_query = "DELETE FROM comments WHERE comment_id = $row_id";
    
        $delete_query_result = mysqli_query($connection, $delete_query);

        header("Location: comments.php");
    
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
                        if(isset($_GET['status'])) {
                            $status = $_GET['status'];
                            $update_status_comment_id = $_GET['p_id'];
                            $status_query = "UPDATE comments SET comment_status = '$status' WHERE comment_id = $update_status_comment_id";
                            $status_query_result = mysqli_query($connection, $status_query);
                            confirm($status_query_result);

                        }

                        // switch($status) {
                        //     case 'add_post';
                        //     include 'includes/add_post.php';

                        //     break;

                        //     case 'edit_post';
                        //     include 'includes/edit_post.php';

                        //     break;
                            
                        //     default:
                        
                        // }
                        
                            include "includes/view_all_comments.php";
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
