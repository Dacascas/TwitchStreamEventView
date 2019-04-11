<?php
echo <<<HERE
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="text-align:center;margin: 0 auto;display: block;">
    <header>
        <nav class="navbar bg-primary navbar-dark navbar-expand-sm" style="background-color:#6441a4 !important;">
            <div class="container">
                <a class="navbar-brand" href="#">Streamer Viewer</a>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row mb-3">
           <div class="col-sm-4 col-md-4"></div>
           <div class="col-sm-8 col-md-8" style="min-height:150px;">
                <button style="margin-top:300px;background-color: #6441a5;  padding:10px;">
                    <a href="$url" style="color:#fff; text-decoration: none">
                    <img width="20" src="twitch.png"> Login with Twitch
                    </a>
                </button>
            </div>
        </div>
    </div>
  </body>
</html>
HERE;