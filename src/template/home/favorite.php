<?php
echo '<html>
        <head></head>
        <body style="padding-left:40%;">
            <p>' . $message . '</p>
            <button style="background-color: #6441a5;  padding:10px; position: absolute; top: 50%;">
                <form method="post">
                    <input type="text" name="streamer-name"/>
                    <input class="favorite styled" type="submit" name="fav" value="Add to favorites">
                </form>
            </button>
            ' . $list .'
        </body>
      </html>';