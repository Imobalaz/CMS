<?php include "includes/admin_header.php"; ?>
<?php include "functions.php"; 
if (!isset($_SESSION['status']) || $_SESSION['role'] != "Admin") {
    header("Location: ../");
}
insert_category();
delete_category()
?>

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
                        

                        <div class="col-xs-6">



                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title" >Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="Add Category" name="submit">
                                </div>
                                <?php 
                                if(isset($info)){
                                    echo "<p>$info</p>";
                                }
                                ?>
                            </form>


                            <form action="" method="post">
                            <?php 

                                if(isset($_GET['update_id'])) {
                                    $update_cat_id = $_GET['update_id'];
                                    $update_cat_title = $_GET['update_title'];
                                    
                                    include "includes/update.php";
                                }

                            ?>

                            </form>
                        </div>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    find_all_categories();
                                ?>     
                                </tbody>
                            </table>
                        </div>
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
