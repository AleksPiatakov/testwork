<?php

if (!isset($staticcommentit)) {
    echo "<div class='add_comment_box'>";
    echo "<p>" . ADD_COMMENT_HEAD_TITLE . "</p>";
    echo "<div id='addfomz'>" . viewform() . "</div>";
    echo "</div>";
}
