<?php

    if (isset($_POST['create_post'])) {
       create_post();
   }

?>






<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <select  name="post_category_id">
            <option value="">--Select a Category--</option>
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
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" id='summernote' name="post_content" cols="30" rows="10"></textarea>
    </div>

    <input value="Publish Post" type="submit" class="btn btn-primary" name="create_post">

</form>