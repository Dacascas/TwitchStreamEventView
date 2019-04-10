<?php
echo '<ul>';
foreach ($list as $item) {
    echo \sprintf("<li><a href=\"/stream/%s\">%s</li>", $item['channel']['_id'], $item['channel']['display_name']);
}
echo '</ul>';