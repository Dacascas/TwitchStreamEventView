<?php
echo '<ul>';
foreach ($list as $item) {
    echo '<li>' . $item['channel']['display_name'] . '</li>';
}
echo '</ul>';