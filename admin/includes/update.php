<?php 
if(isset($_POST['update'])) {
    $update_cat_title = $_POST["update_cat_title"];
    $update_cat_id = $_POST["update_cat_id"];

    if ($update_cat_title == "" || empty($update_cat_title)) {
        $update_info = "This field cannot be blank.";
    } elseif (!$update_cat_id) {
        $update_info = "Category to update is not selected. Please select a category";
    } else {
        $update_cat_title = mysqli_escape_string($connection, $update_cat_title);
        $update_category_query = "UPDATE categories SET cat_title = '$update_cat_title' WHERE cat_id = $update_cat_id";
        
        $update_category_result = mysqli_query($connection, $update_category_query);
        header("Location: categories.php");
        $update_info = "$update_cat_title updated in Categories";

        if(!$update_category_result) {
            die("Could not insert data" . mysqli_errno($connection));
        }

    }
}

?>



    <div class="form-group">
        <label for="update_cat_title" >Edit Category</label>
        <input class="form-control" value="<?php if(isset($update_cat_title)){echo $update_cat_title;} ?>" type="text" name="update_cat_title">
        <input class="form-control" value="<?php if(isset($update_cat_id)){echo $update_cat_id;} ?>" type="hidden" name="update_cat_id">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Update Category" name="update">
    </div>
    <?php 
    if(isset($update_info)){
        echo "<p>$update_info</p>";
    }
    ?>
