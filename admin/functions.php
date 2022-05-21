<?php

function insert_category() {
    global $connection;
    global $info;
    if(isset($_POST['submit'])) {
        $cat_title = $_POST["cat_title"];
        if($cat_title == "" || empty($cat_title)) {
            $info = "This field cannot be blank.";
        }else{
            $cat_title = mysqli_escape_string($connection, $cat_title);
            $add_category_query = "INSERT INTO categories (cat_title) VALUES ('$cat_title')";
            
            $add_category_result = mysqli_query($connection, $add_category_query);
            header("Location: categories.php");
            $info = "$cat_title added to Category";

            if(!$add_category_result) {
                die("Could not insert data" . mysqli_errno($connection));
            }

            $cat_title = "";

        }
    }

}


function find_all_categories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $selected_categories = mysqli_query($connection, $query);

    if ($selected_categories) {
        while ($row = mysqli_fetch_assoc($selected_categories)) {
            $category_title = $row['cat_title'];
            $category_id = $row['cat_id'];
            echo "<tr>";
            echo "<td>$category_id</td>";
            echo "<td>$category_title</td>";
            echo "<td><a href='categories.php?update_id=$category_id&update_title=$category_title'>Edit</a></td>";
            echo "<td><a href='categories.php?delete=$category_id'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        die("Could not select" . mysqli_errno($connection));
    }
}

function delete_category() {
    global $connection;
    if (isset($_GET['delete'])) {
        $row_id = $_GET['delete'];
    
        $delete_query = "DELETE FROM categories WHERE cat_id = $row_id";
    
        $delete_query_result = mysqli_query($connection, $delete_query);

        header("Location: categories.php");
    
        if (!$delete_query_result) {
            die("Could not delete row" . mysqli_errno($connection));
        }
    } 
}

function confirm($result) {
    global $connection;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function create_user() {
    global $connection;
    global $create_user_info;
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $confirm_user_password = $_POST['confirm_user_password'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        $username = mysqli_escape_string($connection, $username);
        $user_firstname = mysqli_escape_string($connection, $user_firstname);
        $user_lastname = mysqli_escape_string($connection, $user_lastname);
        $user_email = mysqli_escape_string($connection, $user_email);
        $user_password = mysqli_escape_string($connection, $user_password);
        $confirm_user_password = mysqli_escape_string($connection, $confirm_user_password);
        $user_image = mysqli_escape_string($connection, $user_image);

        
        
        
        if(!$username) {
            $create_user_info = 'Username field cannot be blank';
        } elseif (!$user_firstname) {
            $create_user_info = 'Firstname field cannot be blank';
        } elseif (!$user_lastname) {
            $create_user_info = 'Lastname field cannot be blank';
        } elseif (!$user_email) {
            $create_user_info = 'Email field cannot be blank';
        } elseif (!$user_password) {
            $create_user_info = 'Password field cannot be blank';
        } elseif (!$confirm_user_password) {
            $create_user_info = 'Confirm your password';
        } elseif ($user_password != $confirm_user_password) {
            $create_user_info = "Passwords do not match";
        } else {
            move_uploaded_file($user_image_temp, "images/$user_image");
            
            $hashFormat = "$2y$10$";
            $salt = "Youwontbelievehowcrazythingsare33";
            $hash_and_salt = $hashFormat . $salt;
    
            $user_password = crypt($user_password, $hash_and_salt);

            $insert_user_query = "INSERT INTO users (username, user_firstname, user_lastname, user_email, user_image, user_password) 
                                VALUES ('$username', '$user_firstname', '$user_lastname', '$user_email', '$user_image', '$user_password')";
            
            $insert_user_result = mysqli_query($connection, $insert_user_query);

            confirm($insert_user_result);
            
        }
        

}
function create_post() {
    global $connection;
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_date = date('d-m-y');

        $post_title = mysqli_escape_string($connection, $post_title);
        $post_author = mysqli_escape_string($connection, $post_author);
        $post_status = mysqli_escape_string($connection, $post_status);
        $post_content = mysqli_escape_string($connection, $post_content);
        $post_tags = mysqli_escape_string($connection, $post_tags);
        $post_image = mysqli_escape_string($connection, $post_image);
        

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $insert_post_query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) 
                            VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status')";
        
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        confirm($insert_post_result);
}


function edit_post($post_id) {
    global $connection;
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_date = date('d-m-y');

        $post_title = mysqli_escape_string($connection, $post_title);
        $post_author = mysqli_escape_string($connection, $post_author);
        $post_status = mysqli_escape_string($connection, $post_status);
        $post_content = mysqli_escape_string($connection, $post_content);
        $post_tags = mysqli_escape_string($connection, $post_tags);
        $post_image = mysqli_escape_string($connection, $post_image);

        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        $update_post_query = "UPDATE posts SET post_title = '$post_title', post_category_id = $post_category_id, post_author = '$post_author', post_content = '$post_content', post_tags = '$post_tags', post_status = '$post_status'";   
        if ($post_image) {
            $update_post_query .= ", post_image = '$post_image'";
        }
        $update_post_query .= "WHERE post_id = $post_id";
        
        $update_post_result = mysqli_query($connection, $update_post_query);

        confirm($update_post_result);
}


function edit_profile($user_id) {
    global $connection;
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email= $_POST['user_email'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        $username = mysqli_escape_string($connection, $username);
        $user_firstname = mysqli_escape_string($connection, $user_firstname);
        $user_lastname = mysqli_escape_string($connection, $user_lastname);
        $user_email = mysqli_escape_string($connection, $user_email);
        $user_image = mysqli_escape_string($connection, $user_image);
        

        move_uploaded_file($user_image_temp, "../images/$user_image");
        $update_user_query = "UPDATE users SET username = '$username', user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_email = '$user_email'";   
        if ($user_image) {
            $update_user_query .= ", user_image = '$user_image'";
        }
        $update_user_query .= "WHERE user_id = $user_id";
        
        $update_user_result = mysqli_query($connection, $update_user_query);

        confirm($update_user_result);

        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $user_firstname;
        $_SESSION['lastname'] = $user_lastname;
        $_SESSION['email'] = $user_email;
        
        if($user_image) {
            $_SESSION['image'] = $user_image;
        }
}