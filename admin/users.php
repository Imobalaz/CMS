<?php include "includes/admin_header.php"; ?>
<?php include "functions.php";

if (!isset($_SESSION['status']) || $_SESSION['role'] != "Admin") {
    header("Location: ../");
}



    if (isset($_GET['delete'])) {
        if(isset($_SESSION['stautus'])) {
        if($_SESSION['role'] == 'Admin') {
          
            $row_id = mysqli_real_escape_string($connection, $_GET['delete']);
            
            $delete_query = "DELETE FROM users WHERE user_id = $row_id";
            
            $delete_query_result = mysqli_query($connection, $delete_query);
            
            header("Location: users.php");
            
            if (!$delete_query_result) {
                die("Could not delete row" . mysqli_errno($connection));
            }
        }
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
                        if(isset($_GET['role'])) {
                            $role = $_GET['role'];
                            $update_role_user_id = $_GET['u_id'];
                            $role_query = "UPDATE users SET user_role = '$role' WHERE user_id = $update_role_user_id";
                            $role_query_result = mysqli_query($connection, $role_query);
                            confirm($role_query_result);

                        }
                            include "includes/view_all_users.php";
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
