<?php
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
$user_firstname = $_SESSION['firstname'];
$user_lastname = $_SESSION['lastname'];
$user_email = $_SESSION['email'];
$user_image = $_SESSION['image'];


if(isset($_POST['edit_profile'])) {
    edit_profile($user_id);
    header("Location: profile.php");
}
?>


<div class="col-md-6">
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Username</label>
            <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
        </div>
        <div class="form-group">
            <label for="title">Firstname</label>
            <input type="text" class="form-control" value="<?php echo $user_firstname; ?>" name="user_firstname">
        </div>
        <div class="form-group">
            <label for="title">Lastname</label>
            <input type="text" class="form-control" value="<?php echo $user_lastname; ?>" name="user_lastname">
        </div>
        
        <div class="form-group">
            <label for="author">Email</label>
            <input type="text" class="form-control" value="<?php echo $user_email; ?>" name="user_email">
        </div>

        <?php
        if($user_image) { ?>
            <div class="form-group">
                <img width="100" src="../images/<?php echo $user_image ?>" alt="">
            </div>

        <?php
        }
        ?>

        <div class="form-group">
            <label for="title">Profile Picture</label>
            <input type="file" name="user_image">
        </div>
        
        <input value="Edit Post" type="submit" class="btn btn-primary" name="edit_profile">

    </form>
</div>