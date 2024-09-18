<?php

include("db/connection.php");

$user_id = $_SESSION['id'];

$stmt = $con->prepare('SELECT other_user_id FROM followings WHERE user_id = ?');

$stmt->bind_param('i', $user_id);
$stmt->execute();

$ids = array();

$result = $stmt->get_result();
while ($row = $result->fetch_array(MYSQLI_NUM)) {
    foreach ($row as $r) {
        $ids[] = $r;
    }
}

// I am not following Anybody.
if (empty($ids)) {

} else {
    $following_ids = join(',', $ids);
    $stmt = $con->prepare("SELECT * FROM users WHERE id IN ($following_ids) ORDER BY RAND() LIMIT 20");
    $stmt->execute();
    $other_people = $stmt->get_result();
}

?>