<?php

echo <<<HERE
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Load the Twitch embed script -->
    <script src="https://embed.twitch.tv/embed/v1.js"></script>

    <!-- Create a Twitch.Embed object that will render within the "twitch-embed" root element. -->
    <script type="text/javascript">
      var embed = new Twitch.Embed("twitch-embed", {
          width   : '100%',
          height  : 'auto',
          channel : "$channelName",
          layout  : "video-with-chat",
          theme   : 'dark',
          autoplay: false
      });

      embed.addEventListener(Twitch.Embed.VIDEO_READY, () => {
        var player = embed.getPlayer();
        player.play();
      });
    </script>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Streamer Event Viewer</a>
            </div>
        </nav>
    </header>
    <section class="section section-shaped section-lg mt-10">
        <div class="container">
            <div class="row mb-3">
                <div class="col-sm">
                    <div class="embed-responsive embed-responsive-16by9">
                        <div id="twitch-embed" class="embed-responsive-item"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </body>
</html>
HERE;