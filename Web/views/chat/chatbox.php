<?php
foreach ($messages as $message) {
    if ($message['sender_id'] == $user_id) {
        echo "<div class=\"message user-1\">" . $message['message'] . "</div>";
    } else {
        echo "<div class=\"message user-2\">" . $message['message'] . "</div>";
    }
}
?>