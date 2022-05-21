<?php
if(isset($_SESSION['info'])){
    session_destroy();
}
?>


<div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                
                <?php
                if(!isset($_SESSION['status'])) {
                    include "includes/login_form.php";
                } 
                ?>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

                            <?php
                            
                             $query = "SELECT * FROM categories";

                            $selected_categories = mysqli_query($connection, $query);

                            if ($selected_rows) {
                                while ($row = mysqli_fetch_assoc($selected_categories)) {
                                    $category_id = $row['cat_id'];
                                    $category_title = $row['cat_title'];
                                    echo ("<li><a href='category.php?p_id=$category_id'>{$category_title}</a></li>");
                                }
                            } else {
                                die("Could not select" . mysqli_errno($connection));
                            }
                            ?>     
                            </ul>
                        </div>
                       
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>