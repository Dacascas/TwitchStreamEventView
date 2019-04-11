<?php
echo <<<HERE
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
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
            <p class="text-info pl-5 pt-4">$message</p>
            <button style="background-color: #6441a5;  padding:10px; position: absolute; top: 50%;">
                <form method="post">
                    <input type="text" name="streamer-name"/>
                    <input class="favorite styled" type="submit" name="fav" value="Add to favorites">
                </form>
            </button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-3">
           <div class="col-sm-4 col-md-4"></div>
           <div class="col-sm-3 col-md-3">$list</div>
        </div>
    </div>
  </body>
</html>
HERE;