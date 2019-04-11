<?php
echo '<ul class="list-group list-group-flush">';
foreach ($list as $item) {
    echo \sprintf("<li class='list-group-item'><a href=\"/streamer/%s\">%s</li>", $item['channel']['_id'], $item['channel']['display_name']);
}
echo '</ul>';