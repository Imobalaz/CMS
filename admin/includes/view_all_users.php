<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php
                                $query = "SELECT * FROM users ORDER BY user_id DESC";
                                $selected_users = mysqli_query($connection, $query);

                                if ($selected_users) {
                                    while ($row = mysqli_fetch_assoc($selected_users)) {
                                        $user_id = $row['user_id'];
                                        $username = $row['username'];
                                        $user_firstname = $row['user_firstname'];
                                        $user_lastname = $row['user_lastname'];
                                        $user_email = $row['user_email'];
                                        $user_role = $row['user_role'];

                                        echo "<tr>";
                                        echo "<td>$user_id</td>";
                                        echo "<td>$username</td>";
                                        echo "<td>$user_firstname</td>";
                                        echo "<td>$user_lastname</td>";
                                        echo "<td>$user_email</td>";
                                        echo "<td>$user_role</td>";
                                        echo "<td><a href='users.php?role=Subscriber&u_id=$user_id'>Subscriber</a></td>";
                                        echo "<td><a href='users.php?role=Admin&u_id=$user_id'>Admin</a></td>";
                                        echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    die("Could not select" . mysqli_errno($connection));
                                }

                            ?>
                            </tbody>
                        </table>