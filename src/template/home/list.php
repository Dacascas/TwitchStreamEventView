<?php
echo '<html>
        <head></head>
        <body style="text-align:center;margin: 0 auto;display: block;">';
            echo '<ul>';
            foreach ($list as $item) {
                echo '<li>' . $item['channel']['display_name'] . '</li>';
            }
            echo '</ul>';

           echo '</body>
      </html>';