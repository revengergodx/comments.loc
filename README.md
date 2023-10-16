Server side for comments app(API).

## Features:
2 types of comments: Main comment(or parent comment or title or whatever you call first comment) and replies to comments.
Validation of data (such user info, commnent) that comes form frontend side of this app([link](https://github.com/revengergodx/commentsvue)).

## Installation:
1.(via built-in artisan server and sqlite) 
Simply clone this repository, create database.sqlite file in /database, create and configure .env file to use sqlite, open project in cmd and run 1.php artisan serve. 2.php artisan migrate:fresh --seed . Now you can access app via Postman(for API requests) or Frontend part([link](https://github.com/revengergodx/commentsvue)).

or

2.(via docker)
Clone this repository. Create and configure .env file. Open project folder in terminal (or wsl terminal) and use docker-compose up -d. Once containers is up, head into app container (comments_app) with command "docker exec -it comments_app bash" and run migrations (php artisan migrate:fresh --seed). Now you can access app via Postman(for API requests) or Frontend part(link).
