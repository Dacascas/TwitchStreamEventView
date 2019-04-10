<?php
echo '<ul>';
foreach ($list as $item) {
    echo \sprintf("<li><a href=\"/stream/%s\">%s</li>", $item['channel']['display_name'], $item['channel']['id']);
}
echo '</ul>';