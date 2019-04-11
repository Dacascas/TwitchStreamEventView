# Twitch Stream Event Viewer

Live DEMO: [LIVE website](https://tranquil-lowlands-72927.herokuapp.com/home)

This repo is an application which exposes two simple pages to the browser
- The first/home page lets a user login with Twitch and set their favorite Twitch streamer name. This initiates a backend event listener which listens to all events for given streamer.
- The second/streamer page shows an embedded livestream, chat and list of 10 most recent events for your favorite streamer. This page doesn’t poll the backend and rather leverages web sockets and relevant Twitch API.

## Technologies used:

- [Slim](http://www.slimframework.com/) : Microframework for managing application state which cant be exposed to clients
- [Bootstrap](https://getbootstrap.com/docs) : Frontend styling
- 3rd Party APIs: [Twitch](https://dev.twitch.tv/docs/)
- [LIVE website](https://tranquil-lowlands-72927.herokuapp.com) Deployment done over Heroku.

## Hosting on AWS

![StreamerAppOnAWS](https://user-images.githubusercontent.com/11471896/54080764-7eaeac80-431d-11e9-96e5-d685c7f0022b.png)

Let me go though components one by one:
- EC2 Group -> Placed in horizontal scaling group in multiple Availability Zones. We can use containers (via ECS|EKS) as well.
- ELB ->  Load balancing incoming traffic
- S3 + Cloudfront (CDN) -> For hosting static assets, the compiled app.js & app.css used in conjunction with unique hash.
- Route53 -> For managing DNS records
- SNS -> In this app we had utilized Pusher for pubsub, on AWS it can be replaced with SNS. 
- Rest depends on how Twitch API is performing, since this app is highly dependent over that. But this architecture on AWS can handle millions of request. Scaling needs to be configured on the basis of *cloudwatch alarms* setted-up on top of CPU & Memory utilization matrices collected from each horizontally placed instances. Keep the minimum instance count, and set maximum as per budget and predetermined traffic case.

The deployment could be via CI like Jenkins or terraform to AWS. Should be separate aws accounts like prod/stage(pre prod)/qa.

It could be next bottleneck:
- network connection between services
- twitch api could not response as expected - we need think about possible additional agreement(SLA) and a way what should do the server in that cases
- autoscaling isn't perfect and we have to have amount of nods which is cover our needs with 20-30 % buffer
  