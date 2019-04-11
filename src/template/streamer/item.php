<?php

echo <<<HERE
<html>
  <body>
    <!-- Add a placeholder for the Twitch embed -->
    <div id="twitch-embed"></div>

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
  </body>
</html>
HERE;