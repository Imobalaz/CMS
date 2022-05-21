<?php
    if(isset($_GET['p_id'])) {
        $post_id = $_GET['p_id'];

        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $selected_post = mysqli_query($connection, $query);
        
        if ($selected_post) {
            $row = mysqli_fetch_assoc($selected_post);
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];
            $post_image = $row['post_image'];
            $post_status = $row['post_status'];
            $post_category_id = $row['post_category_id'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
        } else {
            confirm($selected_post);
        }
    }

   if (isset($_POST['edit_post'])) {
       edit_post($post_id);
       header("Location: posts.php");
   }

?>






<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" value="<?php echo $post_title; ?>" name="title">
    </div>
    <div class="form-group">
        <select  name="post_category_id">
            <?php
            $category_query = "SELECT * FROM categories";
            $selected_categories = mysqli_query($connection, $category_query);
            confirm($selected_categories);
            while($category = mysqli_fetch_assoc($selected_categories)) {
                $category_id = $category['cat_id'];
                $category_title = $category['cat_title'];
                $option = "<option ";
                if ($post_category_id === $category_id) {
                    $option .= "selected ";
                }
                $option .= "value={$category_id}>$category_title</option>";
                echo $option;
            }

            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" value="<?php echo $post_author; ?>" name="author">
    </div>
    <div class="form-group">
        <label for="">Post Status: </label>
        <select name="post_status" id="">
            <option <?php if($post_status === 'Draft') {echo 'selected';} ?> value="Draft">Draft</option>
            <option <?php if($post_status === 'Published') {echo 'selected';} ?> value="Published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
    </div>
    <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" value="<?php echo $post_image; ?>" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" value="<?php echo $post_tags; ?>" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" id="summernote" class="form-control" name="post_content" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <input value="Edit Post" type="submit" class="btn btn-primary" name="edit_post">

</form>