<?php
include '../config/db.php';

$result = mysqli_query($conn, "SELECT * FROM announcements ORDER BY posted_at DESC");
?>

<h2>College Announcements</h2>
<?php while($row = mysqli_fetch_assoc($result)): ?>
    <div>
        <h4><?= $row['title'] ?></h4>
        <p><?= $row['content'] ?></p>
        <small>Posted on <?= $row['posted_at'] ?></small>
        <hr>
    </div>
<?php endwhile; ?>
