<div class="well">
    <h4>Login</h4>
    <form action="includes/login.php" method="post">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Enter Username">
        </div>
        <div class="input-group">
            <input type="password" name="password" class="form-control" placeholder="Enter Password">
            <span class="input-group-btn">
                <button name="login" class="btn btn-default" type="submit">Login</button>
            </span>
        </div>
        <?php
        if(isset($_SESSION['info'])) {
            $info = $_SESSION['info'];
            echo "<p>$info</p>";
        }
        ?>
    </form>
    <!-- /.input-group -->
</div>