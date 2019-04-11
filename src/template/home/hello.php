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
           <div class="col-sm-5 col-md-5"></div>
           <div class="col-sm-7 col-md-7" style="min-height:150px;">
                <button style="margin-top:300px;background-color: #6441a5;  padding:10px;">
                    <a href="$url" style="color:#fff; text-decoration: none">
                    <img width="20" src="twitch.png"> Login with Twitch
                    </a>
                </button>
            </div>
        </div>
    </div>
    <footer class="page-footer font-small blue pt-4">
        <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019 Copyright:
      <a href="https://github.com/Dacascas"> Taras Kostiuk</a>
    </div>
    <!-- Copyright -->
    </footer>
  </body>
</html>
HERE;