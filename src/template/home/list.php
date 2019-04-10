<?php
echo '<ul>';
foreach ($list as $item) {
    echo \sprintf("<li><a href=\"/streamer/%s\">%s</li>", $item['channel']['_id'], $item['channel']['display_name']);
}
echo '</ul>';