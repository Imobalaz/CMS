<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php
                                $query = "SELECT * FROM comments ORDER BY comment_id DESC";
                                $selected_comments = mysqli_query($connection, $query);

                                if ($selected_comments) {
                                    while ($row = mysqli_fetch_assoc($selected_comments)) {
                                        $comment_id = $row['comment_id'];
                                        $comment_author = $row['comment_author'];
                                        $comment_post_id = $row['comment_post_id'];
                                        $comment_date = $row['comment_date'];
                                        $comment_email = $row['comment_email'];
                                        $comment_status = $row['comment_status'];
                                        $comment_content = $row['comment_content'];

                                        $post_name_query = "SELECT post_title FROM posts WHERE post_id = $comment_post_id";
                                        $post_name_result = mysqli_query($connection, $post_name_query);
                                        confirm($post_name_result);
                                        $post_title = mysqli_fetch_assoc($post_name_result);
                                        $comment_post_title = $post_title['post_title'];
                                        echo "<tr>";
                                        echo "<td>$comment_id</td>";
                                        echo "<td>$comment_author</td>";
                                        echo "<td>$comment_content</td>";
                                        echo "<td>$comment_email</td>";
                                        echo "<td>$comment_status</td>";
                                        echo "<td><a href='../post.php?p_id=$comment_post_id'>$comment_post_title</a></td>";
                                        echo "<td>$comment_date</td>";
                                        echo "<td><a href='comments.php?status=Approved&p_id=$comment_id'>Approve</a></td>";
                                        echo "<td><a href='comments.php?status=Unapproved&p_id=$comment_id'>Unapprove</a></td>";
                                        echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    die("Could not select" . mysqli_errno($connection));
                                }

                            ?>
                            </tbody>
                        </table>