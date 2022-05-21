<?php

    if(isset($_POST['checkBoxArray'])) {
        foreach($_POST['checkBoxArray'] as $checkBoxValue) {
            $bulk_options = $_POST['bulk_options'];

            switch($bulk_options) {
                case 'Published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id=$checkBoxValue";
                    $result = mysqli_query($connection, $query);
                    
                    
                break;
                case 'Draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id=$checkBoxValue";
                    $result = mysqli_query($connection, $query);
                    
                    
                break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id=$checkBoxValue";
                    $result = mysqli_query($connection, $query);     
                break;
            }
        }
    }
?>












<form action="" method="post">
    <table class="table table-bordered table-hover">
        
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="Published">Publish</option>
                <option value="Draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
    
    
    
    
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>

            <?php
                $query = "SELECT * FROM posts";
                $selected_posts = mysqli_query($connection, $query);

                if ($selected_posts) {
                    while ($row = mysqli_fetch_assoc($selected_posts)) {
                        $post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_title = $row['post_title'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_status = $row['post_status'];
                        $post_category_id = $row['post_category_id'];
                        $post_tags = $row['post_tags'];
                        $get_approved_comments_query = "SELECT * FROM comments WHERE comment_status = 'Approved' AND comment_post_id = $post_id ORDER BY comment_id DESC";
                        $get_approved_comments_result = mysqli_query($connection, $get_approved_comments_query);
                        confirm($get_approved_comments_result);
                        $post_comment_count = mysqli_num_rows($get_approved_comments_result);
                        $set_comment_count_query = "UPDATE posts SET post_comment_count = $post_comment_count WHERE post_id = $post_id";
                        $set_comment_count_result = mysqli_query($connection, $set_comment_count_query);
                        confirm($set_comment_count_result);

                        $cat_name_query = "SELECT cat_title FROM categories WHERE cat_id = $post_category_id";
                        $cat_name_result = mysqli_query($connection, $cat_name_query);
                        confirm($cat_name_result);
                        $category_title = mysqli_fetch_assoc($cat_name_result);
                        $post_category_title = $category_title['cat_title'];
                        echo "<tr>";
                        echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value=$post_id></td>";
                        echo "<td>$post_id</td>";
                        echo "<td>$post_author</td>";
                        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                        echo "<td>$post_category_title</td>";
                        echo "<td>$post_status</td>";
                        echo "<td><img src='../images/$post_image' width='100'></td>";
                        echo "<td>$post_tags</td>";
                        echo "<td>$post_comment_count</td>";
                        echo "<td>$post_date</td>";
                        echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit Post</a></td>";
                        echo "<td><a href='posts.php?delete=$post_id'>Delete Post</a></td>";
                        echo "</tr>";
                    }
                } else {
                    die("Could not select" . mysqli_errno($connection));
                }

        ?>
        </tbody>
    </table>
</form>