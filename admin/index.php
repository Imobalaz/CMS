<?php include "includes/admin_header.php"; 
if (!isset($_SESSION['status']) || $_SESSION['role'] != "Admin") {
    header("Location: ../");
}
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";
        include "functions.php";
        $get_all_posts_query = "SELECT * FROM POSTS";
        $get_all_posts_result = mysqli_query($connection, $get_all_posts_query);
        confirm($get_all_posts_result);
        $posts_count = mysqli_num_rows($get_all_posts_result);

        $get_all_draft_posts_query = "SELECT * FROM POSTS WHERE post_status = 'Draft'";
        $get_all_draft_posts_result = mysqli_query($connection, $get_all_draft_posts_query);
        confirm($get_all_draft_posts_result);
        $draft_posts_count = mysqli_num_rows($get_all_draft_posts_result);


        $get_all_categories_query = "SELECT * FROM categories";
        $get_all_categories_result = mysqli_query($connection, $get_all_categories_query);
        confirm($get_all_categories_result);
        $categories_count = mysqli_num_rows($get_all_categories_result);


        $get_all_users_query = "SELECT * FROM users";
        $get_all_users_result = mysqli_query($connection, $get_all_users_query);
        confirm($get_all_users_result);
        $users_count = mysqli_num_rows($get_all_users_result);

        $get_all_subscribers_query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
        $get_all_subscribers_result = mysqli_query($connection, $get_all_subscribers_query);
        confirm($get_all_subscribers_result);
        $subscribers_count = mysqli_num_rows($get_all_subscribers_result);


        $get_all_comments_query = "SELECT * FROM comments";
        $get_all_comments_result = mysqli_query($connection, $get_all_comments_query);
        confirm($get_all_comments_result);
        $comments_count = mysqli_num_rows($get_all_comments_result);


        $get_all_pending_comments_query = "SELECT * FROM comments WHERE comment_status='Unapproved'";
        $get_all_pending_comments_result = mysqli_query($connection, $get_all_pending_comments_query);
        confirm($get_all_pending_comments_result);
        $pending_comments_count = mysqli_num_rows($get_all_pending_comments_result);

        
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to ADMIN
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $posts_count; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $comments_count; ?></div>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $users_count; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $categories_count; ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                                $element_name = ['Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers','Categories'];
                                $element_count = [$posts_count, $draft_posts_count, $comments_count, $pending_comments_count, $users_count, $subscribers_count, $categories_count];
                                $element = array_combine($element_name, $element_count);
                                foreach($element as $key=>$value) {
                                    echo "['{$key}'" . ", " . $value . "],";
                                }
                            ?>
                
                            ]);

                            var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>

                    <div id="columnchart_material" style="width: 'auto'; height: 500px;">
                    <!-- <?php
                    foreach($element as $key=>$value) {
                                    echo "['{$key}'" . ", " . $value . "],";
                                }
                    ?> -->
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php";
