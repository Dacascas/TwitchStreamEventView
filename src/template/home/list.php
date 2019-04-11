<?php
echo '<ul class="list-group list-group-flush">';
foreach ($list as $item) {
    echo \sprintf("<li class='list-group-item'><a style='color:#6441a5' href=\"/streamer/%s\">%s</li>", $item['channel']['name'], $item['channel']['display_name']);
}
echo '</ul>';